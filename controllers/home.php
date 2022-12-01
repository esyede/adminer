<?php

defined('DS') or exit('No direct script access.');

use System\Config;
use System\Response;

class Adminer_Home_Controller extends Controller
{
    public function action_index()
    {
        if (! Config::get('adminer::main.enabled')) {
            return Response::error(404);
        }

        // Proteksi route
        $this->middleware('before', array_unique(array_merge(
            Config::get('adminer::main.middlewares', []), ['auth']
        )));

        // Autologin
        $default = Config::get('database.default');
        $db = Config::get('database.connections.'.$default);
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

        return require dirname(__DIR__).DS.'libraries'.DS.'load.php';
    }
}
