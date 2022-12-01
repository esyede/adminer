<?php

defined('DS') or exit('No direct script access.');

/*
|--------------------------------------------------------------------------
| Route
|--------------------------------------------------------------------------
|
| Cukup beri tahu rakit kata kerja HTTP dan URI yang harus ditanggapi.
| Rakit juga mendukung RESTful routing yang sangat cocok untuk membangun
| aplikasi berskala besar maupun API sederhana.
|
*/

Route::any('(:package)/(:any?)', ['before' => config('adminer::main.middlewares', []), function () {
    // Disabled
    abort_if(! config('adminer::main.enabled'), 404);

    // Autologin
    $db = config('database.connections.'.config('database.default'));
    $driver = (is_null($db['driver']) || $db['driver'] === 'mysql') ? 'server' : $db['driver'];

    if (! isset($_GET['db'])) {
        $_POST['auth']['driver'] = $driver;
        $_POST['auth']['server'] = (isset($db['host']) ? $db['host'] : '')
            .(isset($db['port']) ? ':'.$db['port'] : '');
        $_POST['auth']['db'] = ($driver === 'sqlite')
            ? path('storage').'database'.DS.RAKIT_KEY.'-'.$db['database']
            : $db['database'];
        $_POST['auth']['username'] = isset($db['username']) ? $db['username'] : '';
        $_POST['auth']['password'] = isset($db['password']) ? $db['password'] : '';
    }

    return require __DIR__.DS.'libraries'.DS.'load.php';
}]);
