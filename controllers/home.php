<?php

defined('DS') or exit('No direct script access.');

class Adminer_Home_Controller extends Controller
{
    public function action_index()
    {
        if (! Config::get('adminer::main.enabled')) {
            return abort(404);
        }

        // Proteksi route
        $middlewares = Arr::wrap(Config::get('adminer::main.middleware', 'auth'));
        $middlewares = array_merge($middlewares, ['auth']);
        $this->middleware('before', $middlewares);

        // Autologin
        $default = Config::get('database.default');
        $db = Config::get('database.connections.'.$default);
        $driver = (is_null($db['driver']) || $db['driver'] === 'mysql') ? 'server' : $db['driver'];

        if (! isset($_GET['db']) && Config::get('adminer::main.autologin')) {
            $_POST['auth']['driver'] = $driver;
            $_POST['auth']['server'] = isset_or($db['host'], '').(isset($db['port']) ? ':'.$db['port'] : '');
            $_POST['auth']['db'] = ($driver === 'sqlite')
                ? path('storage').'database'.DS.RAKIT_KEY.'-'.$db['database']
                : $db['database'];
            $_POST['auth']['username'] = isset_or($db['username'], '');
            $_POST['auth']['password'] = isset_or($db['password'], '');
        }

        return require dirname(__DIR__).DS.'libraries'.DS.'index.php';
    }
}
