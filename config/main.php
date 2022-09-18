<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Enable
    |--------------------------------------------------------------------------
    |
    | Aktifkan routing ke adminer?
    |
    */

    'enabled' => true,

    /*
    |--------------------------------------------------------------------------
    | Middleware
    |--------------------------------------------------------------------------
    |
    | Middleware untuk proteksi akses ke adminer. Pastikan proteksi ini
    | diaktifkan dan pastikan HANYA ADMIN yang bisa mengakses adminer.
    |
    */

    'middleware' => [
        'auth',
        // 'admin_only',
    ],

    /*
    |--------------------------------------------------------------------------
    | Auto Login
    |--------------------------------------------------------------------------
    |
    | Aktifkan autologin ke database
    | PENTING: Mohon hanya mengaktifkan autologin ketika middleware
    | sudah diatur dengan benar!
    |
    */

    'autologin' => true,

    /*
    |--------------------------------------------------------------------------
    | Password-less Login
    |--------------------------------------------------------------------------
    |
    | Izinkan login ke adminer tanpa menggunakan username dan password.
    | PENTING: Hanya aktifkan ini ketika anda berada di lingkungan lokal saja!
    |
    */

    'passwordless_login' => true,
];
