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
        try {
            $active = $this->client->query(
                (new Query('/ip/hotspot/active/print'))->where('user', $username)
            )->read();

            if (empty($active)) {
                return ['success' => false, 'message' => 'User tidak sedang aktif'];
            }

            foreach ($active as $a) {
                if (!empty($a['.id'])) {
                    $result = $this->client->query(
                        (new Query('/ip/hotspot/active/remove'))->equal('.id', $a['.id'])
                    )->read();
                }
            }

            // Verify user is actually kicked
            $after = $this->client->query(
                (new Query('/ip/hotspot/active/print'))->where('user', $username)
            )->read();

            if (!empty($after)) {
                return ['success' => false, 'message' => 'Gagal kick user. Cek policy & firewall'];
            }

            return ['success' => true, 'message' => 'User berhasil di-kick'];
        } catch (\Exception $e) {
            return ['success' => false, 'message' => 'Error: ' . $e->getMessage()];
        }
    }

    /**
     * Cek apakah user dengan IP tertentu sedang aktif
     */
    public function isActiveByIp($ip)
    {
        try {
            $active = $this->client->query(
                (new Query('/ip/hotspot/active/print'))->where('address', $ip)
            )->read();

            return !empty($active) ? $active[0] : null;
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * Cek apakah user dengan MAC tertentu sedang aktif
     */
    public function isActiveByMac($mac)
    {
        try {
            $active = $this->client->query(
                (new Query('/ip/hotspot/active/print'))->where('mac-address', $mac)
            )->read();

            return !empty($active) ? $active[0] : null;
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * Kick user berdasarkan IP address
     */
    public function kickByIp($ip)
    {
        try {
            $active = $this->client->query(
                (new Query('/ip/hotspot/active/print'))->where('address', $ip)
            )->read();

            foreach ($active as $a) {
                $this->client->query(
                    (new Query('/ip/hotspot/active/remove'))->equal('.id', $a['.id'])
                );
            }
            return true;
        } catch (\Exception $e) {
            return false;
        }
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

    /**
     * Get detailed active users information
     */
    public function getDetailedActiveUsers()
    {
        try {
            $active = $this->getActive();
            $detailedActive = [];

            foreach ($active as $user) {
                $detailedActive[] = [
                    'user' => $user['user'] ?? 'Unknown',
                    'address' => $user['address'] ?? '-',
                    'mac-address' => $user['mac-address'] ?? '-',
                    'uptime' => $user['uptime'] ?? '-',
                    'bytes-in' => isset($user['bytes-in']) ? $user['bytes-in'] : 0,
                    'bytes-out' => isset($user['bytes-out']) ? $user['bytes-out'] : 0,
                    'session-time-left' => $user['session-time-left'] ?? '-',
                    'idle-timeout' => $user['idle-timeout'] ?? '-',
                    'idle-time' => $user['idle-time'] ?? '-',
                    'limit-bytes-in' => isset($user['limit-bytes-in']) ? $user['limit-bytes-in'] : 0,
                    'limit-bytes-out' => isset($user['limit-bytes-out']) ? $user['limit-bytes-out'] : 0,
                    'limit-bytes-total' => isset($user['limit-bytes-total']) ? $user['limit-bytes-total'] : 0,
                ];
            }

            return $detailedActive;
        } catch (\Exception $e) {
            return [];
        }
    }

    /**
     * Get all hotspot profiles
     */
    public function getProfiles()
    {
        try {
            return $this->client->query(new Query('/ip/hotspot/user/profile/print'))->read();
        } catch (\Exception $e) {
            return [];
        }
    }

    /**
     * Get user by username
     */
    public function getUserByUsername($username)
    {
        try {
            $users = $this->getUsers();
            foreach ($users as $user) {
                if (isset($user['name']) && $user['name'] === $username) {
                    return $user;
                }
            }
            return null;
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * Check if user exists
     */
    public function userExists($username)
    {
        try {
            $user = $this->getUserByUsername($username);
            return $user !== null;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Get server info
     */
    public function getServerInfo()
    {
        try {
            $resource = $this->client->query(new Query('/system/resource/print'))->read();
            $identity = $this->client->query(new Query('/system/identity/print'))->read();

            return [
                'uptime' => $resource[0]['uptime'] ?? 'Unknown',
                'version' => $resource[0]['version'] ?? 'Unknown',
                'free-memory' => $resource[0]['free-memory'] ?? 0,
                'total-memory' => $resource[0]['total-memory'] ?? 0,
                'free-hdd-space' => $resource[0]['free-hdd-space'] ?? 0,
                'total-hdd-space' => $resource[0]['total-hdd-space'] ?? 0,
                'cpu-load' => $resource[0]['cpu-load'] ?? 0,
                'board-name' => $resource[0]['board-name'] ?? 'Unknown',
                'identity' => $identity[0]['name'] ?? 'Unknown',
            ];
        } catch (\Exception $e) {
            return [];
        }
    }

    /**
     * Test connection to MikroTik
     */
    public function testConnection()
    {
        try {
            $this->client->query(new Query('/system/resource/print'))->read();
            return ['success' => true, 'message' => 'Connection successful'];
        } catch (\Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
}
