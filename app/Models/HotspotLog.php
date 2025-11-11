<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotspotLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'username',
        'mac_address',
        'ip_address',
        'action',
        'session_id',
        'session_start',
        'session_end',
        'session_duration',
        'user_agent',
        'device_type',
        'browser',
        'platform',
        'bytes_in',
        'bytes_out',
        'packets_in',
        'packets_out',
        'destination_url',
        'error_message',
        'status',
        'metadata'
    ];

    protected $casts = [
        'session_start' => 'datetime',
        'session_end' => 'datetime',
        'metadata' => 'array',
        'bytes_in' => 'integer',
        'bytes_out' => 'integer',
        'packets_in' => 'integer',
        'packets_out' => 'integer',
        'session_duration' => 'integer'
    ];

    /**
     * Scope untuk filter berdasarkan username
     */
    public function scopeByUsername($query, $username)
    {
        return $query->where('username', $username);
    }

    /**
     * Scope untuk filter berdasarkan action
     */
    public function scopeByAction($query, $action)
    {
        return $query->where('action', $action);
    }

    /**
     * Scope untuk filter berdasarkan MAC address
     */
    public function scopeByMac($query, $mac)
    {
        return $query->where('mac_address', $mac);
    }

    /**
     * Scope untuk filter berdasarkan IP address
     */
    public function scopeByIp($query, $ip)
    {
        return $query->where('ip_address', $ip);
    }

    /**
     * Scope untuk filter berdasarkan status
     */
    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope untuk filter berdasarkan rentang tanggal
     */
    public function scopeDateRange($query, $startDate, $endDate)
    {
        return $query->whereBetween('created_at', [$startDate, $endDate]);
    }

    /**
     * Scope untuk hanya login success
     */
    public function scopeSuccessfulLogins($query)
    {
        return $query->where('action', 'login_success')
            ->where('status', 'success');
    }

    /**
     * Scope untuk hanya login failed
     */
    public function scopeFailedLogins($query)
    {
        return $query->where('action', 'login_failed')
            ->where('status', 'failed');
    }

    /**
     * Scope untuk recent logs
     */
    public function scopeRecent($query, $limit = 100)
    {
        return $query->orderBy('created_at', 'desc')->limit($limit);
    }

    /**
     * Accessor untuk format bytes yang human-readable
     */
    public function getFormattedBytesInAttribute()
    {
        return $this->formatBytes($this->bytes_in);
    }

    public function getFormattedBytesOutAttribute()
    {
        return $this->formatBytes($this->bytes_out);
    }

    public function getTotalBytesAttribute()
    {
        return $this->bytes_in + $this->bytes_out;
    }

    public function getFormattedTotalBytesAttribute()
    {
        return $this->formatBytes($this->total_bytes);
    }

    /**
     * Accessor untuk format durasi yang human-readable
     */
    public function getFormattedDurationAttribute()
    {
        if (!$this->session_duration) {
            return '-';
        }

        $hours = floor($this->session_duration / 3600);
        $minutes = floor(($this->session_duration % 3600) / 60);
        $seconds = $this->session_duration % 60;

        if ($hours > 0) {
            return sprintf('%d jam %d menit', $hours, $minutes);
        } elseif ($minutes > 0) {
            return sprintf('%d menit %d detik', $minutes, $seconds);
        } else {
            return sprintf('%d detik', $seconds);
        }
    }

    /**
     * Helper untuk format bytes
     */
    private function formatBytes($bytes, $precision = 2)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];

        for ($i = 0; $bytes > 1024 && $i < count($units) - 1; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, $precision) . ' ' . $units[$i];
    }

    /**
     * Static method untuk get statistics
     */
    public static function getStatistics($startDate = null, $endDate = null)
    {
        $query = self::query();

        if ($startDate && $endDate) {
            $query->dateRange($startDate, $endDate);
        }

        return [
            'total_logins' => $query->clone()->where('action', 'login_success')->count(),
            'total_failed' => $query->clone()->where('action', 'login_failed')->count(),
            'total_logouts' => $query->clone()->where('action', 'logout')->count(),
            'unique_users' => $query->clone()->distinct('username')->count('username'),
            'total_traffic_in' => $query->clone()->sum('bytes_in'),
            'total_traffic_out' => $query->clone()->sum('bytes_out'),
            'avg_session_duration' => $query->clone()->where('session_duration', '>', 0)->avg('session_duration')
        ];
    }

    /**
     * Static method untuk get user history
     */
    public static function getUserHistory($username, $limit = 50)
    {
        return self::byUsername($username)
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }

    /**
     * Static method untuk get recent activities
     */
    public static function getRecentActivities($limit = 100)
    {
        return self::orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }
}
