<?php

namespace App\Http\Controllers;

use App\Services\MikrotikHotspot;
use Illuminate\Http\Request;

class HotspotAdminController extends Controller
{
    public function __construct(private MikrotikHotspot $mt) {}
    public function index()
    {
        return response()->json($this->mt->listUsers());
    }
    public function store(Request $r)
    {
        $data = $r->validate(['name' => 'required', 'password' => 'required', 'profile' => 'nullable']);
        $this->mt->createUser($data['name'], $data['password'], $data['profile'] ?? 'default');
        return response()->json(['ok' => true]);
    }
    public function update(Request $r, string $name)
    {
        $this->mt->updateUser($name, $r->only(['password', 'profile', 'disabled']));
        return response()->json(['ok' => true]);
    }
    public function destroy(string $name)
    {
        $this->mt->deleteUser($name);
        return response()->json(['ok' => true]);
    }
    public function active()
    {
        return response()->json($this->mt->listActive());
    }
    public function kick(string $user)
    {
        $this->mt->kick($user);
        return response()->json(['ok' => true]);
    }
}
