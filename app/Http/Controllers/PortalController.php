<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PortalController extends Controller
{
    public function show(Request $r)
    {
        return view('portal', ['mac' => $r->mac, 'ip' => $r->ip, 'dst' => $r->dst ?? 'http://google.com']);
    }
    public function submit(Request $r)
    {
        $data = $r->validate([
            'username' => 'required',
            'password' => 'required',
            'mac' => 'nullable',
            'ip' => 'nullable',
            'dst' => 'nullable|url'
        ]);

        // catat log awal + validasi opsional ke DB internal kamu
        DB::table('hotspot_logs')->insert([
            'username' => $data['username'],
            'mac' => $data['mac'],
            'ip' => $data['ip'],
            'user_agent' => $r->userAgent(),
            'success' => true,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // relay ke Mikrotik (HTTP PAP) — sesi akan aktif
        return view('relay', [
            'username' => $data['username'],
            'password' => $data['password'],
            'dst' => $data['dst'] ?? 'http://google.com'
        ]);
    }
}
