<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\HotspotLog;
use App\Services\HotspotLogService;

class AdminController extends Controller
{
    protected $logService;

    public function __construct(HotspotLogService $logService)
    {
        $this->logService = $logService;
    }

    /**
     * Tampilkan halaman login admin
     */
    public function showLogin()
    {
        // Jika sudah login, redirect ke logs
        if (Auth::check()) {
            return redirect()->route('admin.logs');
        }

        return view('admin.login');
    }

    /**
     * Proses login admin
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();

            return redirect()->route('admin.logs')->with('success', 'Login berhasil!');
        }

        return back()->withErrors(['error' => 'Email atau password salah'])
            ->withInput(['email' => $request->email]);
    }

    /**
     * Logout admin
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')->with('success', 'Logout berhasil');
    }

    /**
     * Tampilkan halaman logs
     */
    public function logs(Request $request)
    {
        // Auth check handled by middleware

        // Get filters from request
        $filter = $request->input('filter', 'all'); // all, today, week, month
        $action = $request->input('action', 'all');
        $search = $request->input('search', '');
        $perPage = $request->input('per_page', 50);

        // Build query
        $query = HotspotLog::query()->orderBy('created_at', 'desc');

        // Apply date filter
        switch ($filter) {
            case 'today':
                $query->whereDate('created_at', today());
                break;
            case 'week':
                $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
                break;
            case 'month':
                $query->whereMonth('created_at', now()->month)
                    ->whereYear('created_at', now()->year);
                break;
        }

        // Apply action filter
        if ($action !== 'all') {
            $query->where('action', $action);
        }

        // Apply search
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('username', 'like', "%{$search}%")
                    ->orWhere('ip_address', 'like', "%{$search}%")
                    ->orWhere('mac_address', 'like', "%{$search}%");
            });
        }

        // Get paginated results
        $logs = $query->paginate($perPage)->withQueryString();

        // Get statistics
        $stats = $this->getStats($filter);

        return view('admin.logs', compact('logs', 'stats', 'filter', 'action', 'search'));
    }

    /**
     * Tampilkan halaman active users
     */
    public function activeUsers(Request $request)
    {
        try {
            $mikrotik = app(\App\Services\MikrotikService::class);
            $activeUsers = $mikrotik->getActive();

            // Get user stats from logs
            $userStats = [];
            foreach ($activeUsers as $user) {
                $username = $user['user'] ?? 'Unknown';

                // Get total sessions and traffic from logs
                $totalLogins = HotspotLog::where('username', $username)
                    ->where('action', 'login_success')
                    ->count();

                $totalTraffic = HotspotLog::where('username', $username)
                    ->whereIn('action', ['logout', 'kicked'])
                    ->selectRaw('SUM(bytes_in + bytes_out) as total')
                    ->value('total') ?? 0;

                $userStats[$username] = [
                    'total_logins' => $totalLogins,
                    'total_traffic' => $totalTraffic
                ];
            }

            return view('admin.active-users', compact('activeUsers', 'userStats'));
        } catch (\Exception $e) {
            return view('admin.active-users', [
                'activeUsers' => [],
                'userStats' => [],
                'error' => 'Tidak dapat terhubung ke MikroTik: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Kick user dari active session
     */
    public function kickUser(Request $request, $username)
    {
        try {
            $mikrotik = app(\App\Services\MikrotikService::class);
            $result = $mikrotik->kickUser($username);

            if ($result['success']) {
                // Log the kick action (with error handling)
                try {
                    $this->logService->logKick($username, $request->ip(), $request->userAgent());
                } catch (\Exception $logError) {
                    // Log error to Laravel's log instead of stopping the process
                    \Log::warning('Failed to log kick action: ' . $logError->getMessage());
                }

                return redirect()->route('admin.active-users')
                    ->with('success', $result['message']);
            } else {
                return back()->with('error', $result['message']);
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal kick user: ' . $e->getMessage());
        }
    }

    /**
     * Get statistics based on filter
     */
    private function getStats($filter)
    {
        $query = HotspotLog::query();

        // Apply date filter
        switch ($filter) {
            case 'today':
                $query->whereDate('created_at', today());
                break;
            case 'week':
                $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
                break;
            case 'month':
                $query->whereMonth('created_at', now()->month)
                    ->whereYear('created_at', now()->year);
                break;
        }

        return [
            'total_logs' => $query->clone()->count(),
            'total_logins' => $query->clone()->where('action', 'login_success')->count(),
            'total_failed' => $query->clone()->where('action', 'login_failed')->count(),
            'total_logouts' => $query->clone()->where('action', 'logout')->count(),
            'unique_users' => $query->clone()->distinct('username')->count('username'),
            'total_traffic' => $query->clone()->whereIn('action', ['logout', 'kicked'])
                ->selectRaw('SUM(bytes_in + bytes_out) as total')
                ->value('total') ?? 0
        ];
    }
}
