# Setup Portal WiFi BPR CAR

## Konfigurasi Environment (.env)

Tambahkan konfigurasi berikut di file `.env`:

```env
# MikroTik Configuration
MT_HOST=192.168.x.x          # IP MikroTik Router
MT_USER=admin                 # Username admin MikroTik
MT_PASS=password              # Password admin MikroTik
MT_PORT=8728                  # Port API MikroTik (default 8728)
MT_HOTSPOT_IP=login.bprcar.local  # Domain/IP hotspot login MikroTik
```

## Konfigurasi MikroTik

### 1. Setup Hotspot Server Profile

Pada MikroTik, set **HTML Directory** atau **Login Page** ke portal Laravel Anda:

```
/ip hotspot profile
set default html-directory=hotspot
set default login-by=http-pap
```

### 2. Setup Walled Garden

Tambahkan domain portal Laravel ke Walled Garden agar bisa diakses sebelum login:

```
/ip hotspot walled-garden
add dst-host=portal.bprcar.local
add dst-host=yourdomain.com
```

### 3. Setup HTTP Login URL (Opsional)

Jika ingin custom redirect:

```
/ip hotspot profile
set default http-login=http://portal.bprcar.local/
```

## Flow Login

1. User connect ke WiFi
2. MikroTik redirect ke: `http://portal.bprcar.local/?mac=XX:XX:XX&ip=X.X.X.X&dst=...`
3. User input username & password
4. Form submit → Relay page (POST ke MikroTik dalam iframe)
5. Setelah 2 detik → Redirect ke Dashboard
6. User bisa lihat info koneksi & logout

## Features

✅ Auto-redirect ke dashboard jika sudah login
✅ Dashboard dengan info session real-time
✅ Logout button untuk disconnect
✅ Responsive design untuk mobile
✅ Modern UI dengan wave header

## Troubleshooting

### Browser auto-close setelah login (HP)
**Solusi:** Sudah diperbaiki dengan menggunakan iframe untuk submit ke MikroTik, lalu redirect manual ke dashboard. Browser tidak akan tertutup.

### User tidak bisa login
- Pastikan user sudah dibuat di MikroTik (`/ip hotspot user`)
- Cek koneksi API MikroTik (port 8728)
- Cek walled garden sudah include domain portal

### Dashboard tidak muncul setelah login
- Pastikan `MT_HOTSPOT_IP` di `.env` sudah benar
- Cek network antara Laravel server dan MikroTik
- Cek log: `tail -f storage/logs/laravel.log`

## API Endpoints (Admin)

```
GET    /admin/hotspot/users        - List all users
POST   /admin/hotspot/users        - Create user
PATCH  /admin/hotspot/users/{name} - Update user
DELETE /admin/hotspot/users/{name} - Delete user
GET    /admin/hotspot/active       - List active sessions
POST   /admin/hotspot/kick/{user}  - Kick user
```

## License

© 2024 BPR CAR. All rights reserved.

