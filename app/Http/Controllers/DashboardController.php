<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MikrotikService;
use App\Services\HotspotLogService;

class DashboardController extends Controller
{
    protected $mikrotik;
    protected $logService;

    public function __construct(MikrotikService $mikrotik, HotspotLogService $logService)
    {
        $this->mikrotik = $mikrotik;
        $this->logService = $logService;
    }

    /**
     * Tampilkan dashboard user
     */
    public function index(Request $r)
    {
        $ip = $r->input('ip', $r->ip());
        $mac = $r->input('mac', '');

        try {
            // Ambil data session aktif user
            $activeSession = $this->mikrotik->isActiveByIp($ip);

            if (!$activeSession) {
                // Jika tidak ada session aktif, redirect ke login
                return redirect()->route('portal.show')->with('error', 'Sesi Anda telah berakhir. Silakan login kembali.');
            }

            // Format data untuk ditampilkan
            $sessionData = [
                'username' => $activeSession['user'] ?? 'Unknown',
                'ip' => $activeSession['address'] ?? $ip,
                'mac' => $activeSession['mac-address'] ?? $mac,
                'uptime' => $activeSession['uptime'] ?? '0s',
                'bytes_in' => $this->formatBytes($activeSession['bytes-in'] ?? 0),
                'bytes_out' => $this->formatBytes($activeSession['bytes-out'] ?? 0),
                'login_time' => $activeSession['login-by'] ?? 'N/A',
                'server' => $activeSession['server'] ?? 'BPR CAR'
            ];

            // Log dashboard view
            try {
                $this->logService->logDashboardView(
                    $sessionData['username'],
                    $ip,
                    $mac,
                    $r->userAgent()
                );
            } catch (\Exception $e) {
                // Ignore logging errors
            }

            return view('dashboard', compact('sessionData'));
        } catch (\Exception $e) {
            return redirect()->route('portal.show')->with('error', 'Terjadi kesalahan. Silakan coba lagi.');
        }
    }

    /**
     * Logout user dan redirect ke halaman konfirmasi
     */
    public function logout(Request $r)
    {
        $ip = $r->input('ip', $r->ip());
        $mac = $r->input('mac', '');

        try {
            // Ambil data session sebelum di-kick untuk logging
            $activeSession = $this->mikrotik->isActiveByIp($ip);
            
            $username = 'Unknown';
            $sessionData = [];
            
            if ($activeSession) {
                $username = $activeSession['user'] ?? 'Unknown';
                
                // Collect session data for logging
                $sessionData = [
                    'session_id' => $activeSession['.id'] ?? null,
                    'bytes_in' => $activeSession['bytes-in'] ?? 0,
                    'bytes_out' => $activeSession['bytes-out'] ?? 0,
                    'packets_in' => $activeSession['packets-in'] ?? 0,
                    'packets_out' => $activeSession['packets-out'] ?? 0,
                    'uptime' => $activeSession['uptime'] ?? '0s',
                    'server' => $activeSession['server'] ?? 'N/A',
                    'login_by' => $activeSession['login-by'] ?? 'N/A'
                ];
            }

            // Kick user dari MikroTik
            $this->mikrotik->kickByIp($ip);

            // Log logout
            try {
                $this->logService->logLogout(
                    $username,
                    $ip,
                    $mac,
                    $sessionData,
                    $r->userAgent()
                );
            } catch (\Exception $e) {
                // Ignore logging errors
            }

            return view('logout-success');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal logout. Silakan coba lagi.');
        }
    }

    /**
     * Format bytes ke format yang readable (KB, MB, GB)
     */
    private function formatBytes($bytes, $precision = 2)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];

        for ($i = 0; $bytes > 1024 && $i < count($units) - 1; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, $precision) . ' ' . $units[$i];
    }
}

