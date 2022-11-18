<?php

defined('DS') or exit('No direct script access.');

function adminer_object()
{
    include_once __DIR__.DS.'plugins'.DS.'plugin.php';
    $files = glob(__DIR__.DS.'plugins'.DS.'*.php');

    foreach ($files as $file) {
        include_once $file;
    }

    $plugins = [
        new AdminerEditForeign(),
        new AdminerCollations(),
        new AdminerEnumTypes(),
        new AdminerDumpJson(),
        new AdminerDatabaseHide([
            'test',
            'mysql',
            'information_schema',
            'performance_schema',
        ]),
    ];

    if (Config::get('adminer::main.passwordless_login')) {
        $plugins[] = new AdminerLoginPasswordLess();
    }

    return new AdminerPlugin($plugins);
}

include __DIR__.DS.'adminer.php';
