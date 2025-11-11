<?php

namespace App\Services;

use App\Models\HotspotLog;
use Illuminate\Support\Facades\Request;
use Jenssegers\Agent\Agent;

class HotspotLogService
{
    /**
     * Log login attempt
     */
    public function logLoginAttempt($username, $ip, $mac = '', $userAgent = null, $destination = null)
    {
        $deviceInfo = $this->parseUserAgent($userAgent ?? request()->userAgent());

        return HotspotLog::create([
            'username' => $username,
            'ip_address' => $ip,
            'mac_address' => $mac,
            'action' => 'login_attempt',
            'status' => 'pending',
            'user_agent' => $userAgent ?? request()->userAgent(),
            'device_type' => $deviceInfo['device_type'],
            'browser' => $deviceInfo['browser'],
            'platform' => $deviceInfo['platform'],
            'destination_url' => $destination
        ]);
    }

    /**
     * Log successful login
     */
    public function logLoginSuccess($username, $ip, $mac = '', $sessionData = [], $userAgent = null, $destination = null)
    {
        $deviceInfo = $this->parseUserAgent($userAgent ?? request()->userAgent());

        return HotspotLog::create([
            'username' => $username,
            'ip_address' => $ip,
            'mac_address' => $mac,
            'action' => 'login_success',
            'status' => 'success',
            'session_id' => $sessionData['session_id'] ?? null,
            'session_start' => now(),
            'user_agent' => $userAgent ?? request()->userAgent(),
            'device_type' => $deviceInfo['device_type'],
            'browser' => $deviceInfo['browser'],
            'platform' => $deviceInfo['platform'],
            'destination_url' => $destination,
            'metadata' => $sessionData
        ]);
    }

    /**
     * Log failed login
     */
    public function logLoginFailed($username, $ip, $mac = '', $errorMessage = '', $userAgent = null, $destination = null)
    {
        $deviceInfo = $this->parseUserAgent($userAgent ?? request()->userAgent());

        return HotspotLog::create([
            'username' => $username,
            'ip_address' => $ip,
            'mac_address' => $mac,
            'action' => 'login_failed',
            'status' => 'failed',
            'error_message' => $errorMessage,
            'user_agent' => $userAgent ?? request()->userAgent(),
            'device_type' => $deviceInfo['device_type'],
            'browser' => $deviceInfo['browser'],
            'platform' => $deviceInfo['platform'],
            'destination_url' => $destination
        ]);
    }

    /**
     * Log logout
     */
    public function logLogout($username, $ip, $mac = '', $sessionData = [], $userAgent = null)
    {
        $deviceInfo = $this->parseUserAgent($userAgent ?? request()->userAgent());

        // Calculate session duration if session_start is available
        $sessionDuration = null;
        $sessionStart = null;
        $sessionEnd = now();

        // Try to get last login success log to calculate duration
        $lastLogin = HotspotLog::where('username', $username)
            ->where('ip_address', $ip)
            ->where('action', 'login_success')
            ->orderBy('created_at', 'desc')
            ->first();

        if ($lastLogin && $lastLogin->session_start) {
            $sessionStart = $lastLogin->session_start;
            $sessionDuration = $sessionEnd->diffInSeconds($sessionStart);
        }

        // Get traffic data from session
        $bytesIn = $sessionData['bytes_in'] ?? 0;
        $bytesOut = $sessionData['bytes_out'] ?? 0;
        $packetsIn = $sessionData['packets_in'] ?? 0;
        $packetsOut = $sessionData['packets_out'] ?? 0;

        return HotspotLog::create([
            'username' => $username,
            'ip_address' => $ip,
            'mac_address' => $mac,
            'action' => 'logout',
            'status' => 'success',
            'session_id' => $sessionData['session_id'] ?? null,
            'session_start' => $sessionStart,
            'session_end' => $sessionEnd,
            'session_duration' => $sessionDuration,
            'bytes_in' => $bytesIn,
            'bytes_out' => $bytesOut,
            'packets_in' => $packetsIn,
            'packets_out' => $packetsOut,
            'user_agent' => $userAgent ?? request()->userAgent(),
            'device_type' => $deviceInfo['device_type'],
            'browser' => $deviceInfo['browser'],
            'platform' => $deviceInfo['platform'],
            'metadata' => $sessionData
        ]);
    }

    /**
     * Log when user is kicked
     */
    public function logKicked($username, $ip, $mac = '', $sessionData = [], $reason = '')
    {
        // Calculate session duration
        $sessionDuration = null;
        $sessionStart = null;
        $sessionEnd = now();

        $lastLogin = HotspotLog::where('username', $username)
            ->where('ip_address', $ip)
            ->where('action', 'login_success')
            ->orderBy('created_at', 'desc')
            ->first();

        if ($lastLogin && $lastLogin->session_start) {
            $sessionStart = $lastLogin->session_start;
            $sessionDuration = $sessionEnd->diffInSeconds($sessionStart);
        }

        // Get traffic data
        $bytesIn = $sessionData['bytes_in'] ?? 0;
        $bytesOut = $sessionData['bytes_out'] ?? 0;
        $packetsIn = $sessionData['packets_in'] ?? 0;
        $packetsOut = $sessionData['packets_out'] ?? 0;

        return HotspotLog::create([
            'username' => $username,
            'ip_address' => $ip,
            'mac_address' => $mac,
            'action' => 'kicked',
            'status' => 'success',
            'session_id' => $sessionData['session_id'] ?? null,
            'session_start' => $sessionStart,
            'session_end' => $sessionEnd,
            'session_duration' => $sessionDuration,
            'bytes_in' => $bytesIn,
            'bytes_out' => $bytesOut,
            'packets_in' => $packetsIn,
            'packets_out' => $packetsOut,
            'error_message' => $reason,
            'metadata' => $sessionData
        ]);
    }

    /**
     * Log admin kick action
     */
    public function logKick($username, $ip, $userAgent = null)
    {
        $deviceInfo = $this->parseUserAgent($userAgent ?? request()->userAgent());

        return HotspotLog::create([
            'username' => $username,
            'ip_address' => $ip,
            'action' => 'admin_kick',
            'status' => 'success',
            'user_agent' => $userAgent ?? request()->userAgent(),
            'device_type' => $deviceInfo['device_type'],
            'browser' => $deviceInfo['browser'],
            'platform' => $deviceInfo['platform']
        ]);
    }

    /**
     * Log dashboard view
     */
    public function logDashboardView($username, $ip, $mac = '', $userAgent = null)
    {
        $deviceInfo = $this->parseUserAgent($userAgent ?? request()->userAgent());

        return HotspotLog::create([
            'username' => $username,
            'ip_address' => $ip,
            'mac_address' => $mac,
            'action' => 'view_dashboard',
            'status' => 'success',
            'user_agent' => $userAgent ?? request()->userAgent(),
            'device_type' => $deviceInfo['device_type'],
            'browser' => $deviceInfo['browser'],
            'platform' => $deviceInfo['platform']
        ]);
    }

    /**
     * Parse user agent to get device information
     */
    private function parseUserAgent($userAgent)
    {
        try {
            $agent = new Agent();
            $agent->setUserAgent($userAgent);

            $deviceType = 'desktop';
            if ($agent->isMobile()) {
                $deviceType = 'mobile';
            } elseif ($agent->isTablet()) {
                $deviceType = 'tablet';
            } elseif ($agent->isDesktop()) {
                $deviceType = 'desktop';
            }

            return [
                'device_type' => $deviceType,
                'browser' => $agent->browser() . ' ' . $agent->version($agent->browser()),
                'platform' => $agent->platform() . ' ' . $agent->version($agent->platform())
            ];
        } catch (\Exception $e) {
            return [
                'device_type' => 'unknown',
                'browser' => 'Unknown',
                'platform' => 'Unknown'
            ];
        }
    }

    /**
     * Get user session statistics
     */
    public function getUserStats($username)
    {
        $logs = HotspotLog::where('username', $username)->get();

        $totalLogins = $logs->where('action', 'login_success')->count();
        $totalLogouts = $logs->where('action', 'logout')->count();
        $totalDuration = $logs->where('action', 'logout')->sum('session_duration');
        $totalBytesIn = $logs->whereIn('action', ['logout', 'kicked'])->sum('bytes_in');
        $totalBytesOut = $logs->whereIn('action', ['logout', 'kicked'])->sum('bytes_out');

        return [
            'username' => $username,
            'total_logins' => $totalLogins,
            'total_logouts' => $totalLogouts,
            'total_duration' => $totalDuration,
            'total_bytes_in' => $totalBytesIn,
            'total_bytes_out' => $totalBytesOut,
            'total_bytes' => $totalBytesIn + $totalBytesOut,
            'avg_duration' => $totalLogouts > 0 ? $totalDuration / $totalLogouts : 0,
            'last_login' => $logs->where('action', 'login_success')->sortByDesc('created_at')->first(),
            'last_logout' => $logs->where('action', 'logout')->sortByDesc('created_at')->first()
        ];
    }

    /**
     * Get recent activities
     */
    public function getRecentActivities($limit = 100, $filters = [])
    {
        $query = HotspotLog::query();

        if (isset($filters['username'])) {
            $query->where('username', $filters['username']);
        }

        if (isset($filters['action'])) {
            $query->where('action', $filters['action']);
        }

        if (isset($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        if (isset($filters['start_date']) && isset($filters['end_date'])) {
            $query->whereBetween('created_at', [$filters['start_date'], $filters['end_date']]);
        }

        return $query->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }

    /**
     * Get overall statistics
     */
    public function getOverallStats($startDate = null, $endDate = null)
    {
        $query = HotspotLog::query();

        if ($startDate && $endDate) {
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }

        $totalLogins = $query->clone()->where('action', 'login_success')->count();
        $totalFailed = $query->clone()->where('action', 'login_failed')->count();
        $totalLogouts = $query->clone()->where('action', 'logout')->count();
        $uniqueUsers = $query->clone()->distinct('username')->count('username');
        $totalBytesIn = $query->clone()->whereIn('action', ['logout', 'kicked'])->sum('bytes_in');
        $totalBytesOut = $query->clone()->whereIn('action', ['logout', 'kicked'])->sum('bytes_out');
        $avgDuration = $query->clone()->where('session_duration', '>', 0)->avg('session_duration');

        return [
            'total_logins' => $totalLogins,
            'total_failed' => $totalFailed,
            'total_logouts' => $totalLogouts,
            'unique_users' => $uniqueUsers,
            'total_bytes_in' => $totalBytesIn,
            'total_bytes_out' => $totalBytesOut,
            'total_bytes' => $totalBytesIn + $totalBytesOut,
            'avg_session_duration' => $avgDuration,
            'success_rate' => ($totalLogins + $totalFailed) > 0 
                ? round(($totalLogins / ($totalLogins + $totalFailed)) * 100, 2) 
                : 0
        ];
    }
}

