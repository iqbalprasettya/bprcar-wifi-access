<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\HotspotLogService;
use App\Services\MikrotikService;

class PortalController extends Controller
{
    protected $logService;
    protected $mikrotik;

    public function __construct(HotspotLogService $logService, MikrotikService $mikrotik)
    {
        $this->logService = $logService;
        $this->mikrotik = $mikrotik;
    }

    /**
     * Tampilkan halaman portal login
     * Menerima parameter dari MikroTik: mac, ip, dst
     * Jika user sudah login, redirect ke dashboard
     */
    public function show(Request $r)
    {
        $ip = $r->input('ip', $r->ip());
        $mac = $r->input('mac', '');
        $dst = $r->input('dst', 'http://google.com');

        // Cek apakah user sudah aktif di MikroTik
        try {
            $activeSession = $this->mikrotik->isActiveByIp($ip);

            if ($activeSession) {
                // User sudah login, redirect ke dashboard
                return redirect()->route('dashboard', [
                    'ip' => $ip,
                    'mac' => $mac,
                    'dst' => $dst
                ]);
            }
        } catch (\Exception $e) {
            // Jika error koneksi MikroTik, tetap tampilkan form login
        }

        return view('portal', [
            'mac' => $mac,
            'ip' => $ip,
            'dst' => $dst
        ]);
    }

    /**
     * Proses submit form login dan relay ke MikroTik
     * PENTING: POST ini HARUS dilakukan oleh browser klien,
     * supaya Mikrotik bisa mengikat sesi ke IP/MAC klien.
     */
    public function submit(Request $r)
    {
        $data = $r->validate([
            'username' => 'required|string',
            'password' => 'required|string',
            'mac' => 'nullable|string',
            'ip' => 'nullable|string',
            'dst' => 'nullable|string'
        ]);

        $ip = $data['ip'] ?? $r->ip();
        $mac = $data['mac'] ?? '';
        $dst = $data['dst'] ?? 'http://google.com';
        $username = $data['username'];
        $password = $data['password'];

        // Validasi dasar
        if (empty($username) || empty($password)) {
            // Log login failed - empty credentials
            try {
                $this->logService->logLoginFailed(
                    $username ?: 'unknown',
                    $ip,
                    $mac,
                    'Username atau password kosong',
                    $r->userAgent(),
                    $dst
                );
            } catch (\Exception $e) {
                // Ignore logging errors
            }

            return back()->withErrors(['error' => 'Username dan password harus diisi'])->withInput();
        }

        // Log login attempt
        try {
            $this->logService->logLoginAttempt(
                $username,
                $ip,
                $mac,
                $r->userAgent(),
                $dst
            );
        } catch (\Exception $e) {
            // Ignore logging errors
        }

        // Validasi kredensial dengan MikroTik (optional)
        try {
            $isValidUser = $this->mikrotik->validateUser($username, $password);

            if (!$isValidUser) {
                // Log login failed - invalid credentials
                $this->logService->logLoginFailed(
                    $username,
                    $ip,
                    $mac,
                    'Username atau password salah',
                    $r->userAgent(),
                    $dst
                );

                return back()->withErrors(['error' => 'Username atau password salah'])->withInput(['username' => $username]);
            }
        } catch (\Exception $e) {
            // Jika validasi gagal, tetap lanjut ke relay
            // Biarkan MikroTik yang handle validasi final
        }

        // Log login success (akan diupdate di DashboardController saat user berhasil masuk)
        try {
            $this->logService->logLoginSuccess(
                $username,
                $ip,
                $mac,
                ['attempted_at' => now()],
                $r->userAgent(),
                $dst
            );
        } catch (\Exception $e) {
            // Ignore logging errors
        }

        // Relay ke Mikrotik dengan redirect ke dashboard setelah login
        return view('relay', [
            'username' => $username,
            'password' => $password,
            'dst' => route('dashboard', ['ip' => $ip, 'mac' => $mac]),
            'ip' => $ip,
            'mac' => $mac
        ]);
    }
}
