<?php

defined('DS') or exit('No direct script access.');

function adminer_object()
{
    include_once __DIR__.DS.'plugins'.DS.'plugin.php';
    $files = glob(__DIR__.DS.'plugins'.DS.'*.php');

    foreach ($files as $file) {
        include_once $file;
    }

    return new \AdminerPlugin([
        new \AdminerEditForeign(),
        new \AdminerCollations(),
        new \AdminerEnumTypes(),
        new \AdminerDumpJson(),
        new \AdminerLoginPasswordLess(),
        new \AdminerDatabaseHide(\System\Config::get('adminer::main.hide_databases')),
    ]);
}

include __DIR__.DS.'adminer.php';
