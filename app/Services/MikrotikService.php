<?php

namespace App\Services;

use RouterOS\Client;
use RouterOS\Query;
use Exception;

class MikrotikService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            'host' => env('MT_HOST'),
            'user' => env('MT_USER'),
            'pass' => env('MT_PASS'),
            'port' => (int) env('MT_PORT', 8728),
            'timeout' => 5,
        ]);
    }

    public function getUsers()
    {
        return $this->client->query(new Query('/ip/hotspot/user/print'))->read();
    }

    public function getActive()
    {
        return $this->client->query(new Query('/ip/hotspot/active/print'))->read();
    }

    public function getHosts()
    {
        return $this->client->query(new Query('/ip/hotspot/host/print'))->read();
    }

    public function createUser($name, $password, $profile = 'default')
    {
        $q = (new Query('/ip/hotspot/user/add'))
            ->equal('name', $name)
            ->equal('password', $password)
            ->equal('profile', $profile);

        return $this->client->query($q)->read();
    }

    public function updateUser($id, $password = null, $profile = null)
    {
        $q = (new Query('/ip/hotspot/user/set'))->equal('.id', $id);
        if ($password) $q->equal('password', $password);
        if ($profile) $q->equal('profile', $profile);

        return $this->client->query($q)->read();
    }

    public function deleteUser($id)
    {
        return $this->client->query(
            (new Query('/ip/hotspot/user/remove'))->equal('.id', $id)
        )->read();
    }

    public function kickUser($username)
    {
        $active = $this->client->query(
            (new Query('/ip/hotspot/active/print'))->where('user', $username)
        )->read();

        foreach ($active as $a) {
            $this->client->query(
                (new Query('/ip/hotspot/active/remove'))->equal('.id', $a['.id'])
            );
        }
        return true;
    }
}
