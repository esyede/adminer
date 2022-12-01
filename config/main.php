<?php

defined('DS') or exit('No direct script access.');

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

    'middlewares' => [
        'auth',
        // 'admin_only',
    ],

    /*
    |--------------------------------------------------------------------------
    | Hide Database
    |--------------------------------------------------------------------------
    |
    | Jangan tampilkan database berikut pada adminer.
    |
    */

    'hide_databases' => [
        // 'information_schema',
        // 'performance_schema',
    ],
];
