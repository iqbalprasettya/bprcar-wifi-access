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
     */
    public function show(Request $r)
    {
        return view('portal', [
            'mac' => $r->input('mac', ''),
            'ip' => $r->input('ip', ''),
            'dst' => $r->input('dst', 'http://google.com')
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

        // Catat log login (optional, hanya jika tabel ada)
        try {
            if (Schema::hasTable('hotspot_logs')) {
                DB::table('hotspot_logs')->insert([
                    'username' => $data['username'],
                    'mac' => $data['mac'] ?? null,
                    'ip' => $data['ip'] ?? null,
                    'user_agent' => $r->userAgent(),
                    'success' => true,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        } catch (\Exception $e) {
            // Abaikan error logging, tetap lanjut ke relay
        }

        // Relay ke Mikrotik (HTTP PAP) — sesi akan aktif
        return view('relay', [
            'username' => $data['username'],
            'password' => $data['password'],
            'dst' => $data['dst'] ?? 'http://google.com'
        ]);
    }
}
