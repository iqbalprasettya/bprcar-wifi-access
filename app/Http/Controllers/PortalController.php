<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class PortalController extends Controller
{
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
            $mikrotik = app(\App\Services\MikrotikService::class);
            $activeSession = $mikrotik->isActiveByIp($ip);

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

        // Validasi dasar
        if (empty($data['username']) || empty($data['password'])) {
            return back()->withErrors(['error' => 'Username dan password harus diisi'])->withInput();
        }

        $ip = $data['ip'] ?? $r->ip();
        $mac = $data['mac'] ?? '';

        // Catat log login (optional, hanya jika tabel ada)
        try {
            if (Schema::hasTable('hotspot_logs')) {
                DB::table('hotspot_logs')->insert([
                    'username' => $data['username'],
                    'mac' => $mac,
                    'ip' => $ip,
                    'user_agent' => $r->userAgent(),
                    'success' => true,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        } catch (\Exception $e) {
            // Abaikan error logging, tetap lanjut ke relay
        }

        // Relay ke Mikrotik dengan redirect ke dashboard setelah login
        return view('relay', [
            'username' => $data['username'],
            'password' => $data['password'],
            'dst' => route('dashboard', ['ip' => $ip, 'mac' => $mac]),
            'ip' => $ip,
            'mac' => $mac
        ]);
    }
}
