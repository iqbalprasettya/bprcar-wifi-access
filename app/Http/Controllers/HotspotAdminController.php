<?php

namespace App\Http\Controllers;

use App\Services\MikrotikService;
use Illuminate\Http\Request;

class HotspotAdminController extends Controller
{
    protected $mikrotik;

    public function __construct(MikrotikService $mikrotik)
    {
        $this->mikrotik = $mikrotik;
    }

    /**
     * List semua hotspot users
     */
    public function index()
    {
        try {
            $users = $this->mikrotik->getUsers();
            return response()->json(['success' => true, 'data' => $users]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Buat user hotspot baru
     */
    public function store(Request $r)
    {
        $data = $r->validate([
            'name' => 'required|string',
            'password' => 'required|string',
            'profile' => 'nullable|string'
        ]);

        try {
            $this->mikrotik->createUser(
                $data['name'],
                $data['password'],
                $data['profile'] ?? 'default'
            );
            return response()->json(['success' => true, 'message' => 'User berhasil dibuat']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Update user hotspot (cari berdasarkan name, lalu update)
     */
    public function update(Request $r, string $name)
    {
        $data = $r->validate([
            'password' => 'nullable|string',
            'profile' => 'nullable|string'
        ]);

        try {
            // Cari user berdasarkan name untuk mendapatkan .id
            $users = $this->mikrotik->getUsers();
            $userId = null;

            foreach ($users as $user) {
                if (isset($user['name']) && $user['name'] === $name) {
                    $userId = $user['.id'];
                    break;
                }
            }

            if (!$userId) {
                return response()->json(['success' => false, 'message' => 'User tidak ditemukan'], 404);
            }

            $this->mikrotik->updateUser(
                $userId,
                $data['password'] ?? null,
                $data['profile'] ?? null
            );

            return response()->json(['success' => true, 'message' => 'User berhasil diupdate']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Hapus user hotspot (cari berdasarkan name, lalu hapus)
     */
    public function destroy(string $name)
    {
        try {
            // Cari user berdasarkan name untuk mendapatkan .id
            $users = $this->mikrotik->getUsers();
            $userId = null;

            foreach ($users as $user) {
                if (isset($user['name']) && $user['name'] === $name) {
                    $userId = $user['.id'];
                    break;
                }
            }

            if (!$userId) {
                return response()->json(['success' => false, 'message' => 'User tidak ditemukan'], 404);
            }

            $this->mikrotik->deleteUser($userId);
            return response()->json(['success' => true, 'message' => 'User berhasil dihapus']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * List user yang sedang aktif/online
     */
    public function active()
    {
        try {
            $active = $this->mikrotik->getActive();
            return response()->json(['success' => true, 'data' => $active]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Kick/disconnect user yang sedang aktif
     */
    public function kick(string $user)
    {
        try {
            $this->mikrotik->kickUser($user);
            return response()->json(['success' => true, 'message' => 'User berhasil di-kick']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}
