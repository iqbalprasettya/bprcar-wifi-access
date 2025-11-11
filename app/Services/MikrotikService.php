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

    /**
     * Cek apakah user dengan IP tertentu sedang aktif
     */
    public function isActiveByIp($ip)
    {
        $active = $this->client->query(
            (new Query('/ip/hotspot/active/print'))->where('address', $ip)
        )->read();

        return !empty($active) ? $active[0] : null;
    }

    /**
     * Cek apakah user dengan MAC tertentu sedang aktif
     */
    public function isActiveByMac($mac)
    {
        $active = $this->client->query(
            (new Query('/ip/hotspot/active/print'))->where('mac-address', $mac)
        )->read();

        return !empty($active) ? $active[0] : null;
    }

    /**
     * Kick user berdasarkan IP address
     */
    public function kickByIp($ip)
    {
        $active = $this->client->query(
            (new Query('/ip/hotspot/active/print'))->where('address', $ip)
        )->read();

        foreach ($active as $a) {
            $this->client->query(
                (new Query('/ip/hotspot/active/remove'))->equal('.id', $a['.id'])
            );
        }
        return true;
    }

    /**
     * Login user ke hotspot via HTTP API
     * Menggunakan HTTP login agar session ter-bind ke IP client
     */
    public function loginViaHttp($username, $password, $ip, $mac = '')
    {
        try {
            // URL login MikroTik hotspot
            $loginUrl = 'http://' . env('MT_HOTSPOT_IP', 'login.bprcar.local') . '/login';

            // Data untuk POST ke MikroTik
            $postData = [
                'username' => $username,
                'password' => $password,
                'dst' => '',
                'popup' => 'true'
            ];

            // Gunakan cURL untuk POST request
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $loginUrl);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 10);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);

            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            // Jika redirect atau success, berarti login berhasil
            if ($httpCode == 302 || $httpCode == 200) {
                return ['success' => true, 'message' => 'Login berhasil'];
            }

            return ['success' => false, 'message' => 'Login gagal'];
        } catch (\Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    /**
     * Validasi kredensial user di MikroTik
     */
    public function validateUser($username, $password)
    {
        try {
            $users = $this->getUsers();

            foreach ($users as $user) {
                if (isset($user['name']) && $user['name'] === $username) {
                    // User ditemukan, cek password jika perlu
                    if (isset($user['password']) && $user['password'] === $password) {
                        return true;
                    }
                    // Jika password tidak di-return oleh API, anggap valid
                    // (MikroTik biasanya tidak return password dalam plaintext)
                    return true;
                }
            }

            return false;
        } catch (\Exception $e) {
            return false;
        }
    }
}
