<?php

namespace App\Services;

use RouterOS\Client;
use RouterOS\Query;

class MikrotikHotspot
{
    private Client $c;
    public function __construct()
    {
        $this->c = new Client([
            'host' => env('MT_HOST'),
            'user' => env('MT_USER'),
            'pass' => env('MT_PASS'),
            'port' => (int)env('MT_PORT', 8728),
            'timeout' => 5,
        ]);
    }
    public function listUsers(): array
    {
        return $this->c->query(new Query('/ip/hotspot/user/print'))->read();
    }
    public function getUser(string $name): ?array
    {
        $res = $this->c->query((new Query('/ip/hotspot/user/print'))->where('name', $name))->read();
        return $res[0] ?? null;
    }
    public function createUser(string $name, string $password, string $profile = 'default'): void
    {
        $q = (new Query('/ip/hotspot/user/add'))->equal('name', $name)->equal('password', $password)->equal('profile', $profile);
        $this->c->query($q);
    }
    public function updateUser(string $name, array $fields): void
    {
        $u = $this->getUser($name);
        if (!$u || empty($u['.id'])) return;
        $q = (new Query('/ip/hotspot/user/set'))->equal('.id', $u['.id']);
        foreach ($fields as $k => $v) {
            $q->equal($k, (string)$v);
        }
        $this->c->query($q);
    }
    public function deleteUser(string $name): void
    {
        $u = $this->getUser($name);
        if (!$u || empty($u['.id'])) return;
        $this->c->query((new Query('/ip/hotspot/user/remove'))->equal('.id', $u['.id']));
    }
    public function listActive(): array
    {
        return $this->c->query(new Query('/ip/hotspot/active/print'))->read();
    }
    public function kick(string $user): void
    {
        $act = $this->c->query((new Query('/ip/hotspot/active/print'))->where('user', $user))->read();
        foreach ($act as $row) {
            if (!empty($row['.id'])) $this->c->query((new Query('/ip/hotspot/active/remove'))->equal('.id', $row['.id']));
        }
    }
    public function listProfiles(): array
    {
        return $this->c->query(new Query('/ip/hotspot/user/profile/print'))->read();
    }
}
