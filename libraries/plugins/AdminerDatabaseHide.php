<?php

defined('DS') or exit('No direct script access.');

class AdminerDatabaseHide
{
    protected $disabled;

    public function __construct($disabled)
    {
        $this->disabled = array_map('strtolower', $disabled);
    }

    public function databases($flush = true)
    {
        $databases = get_databases($flush);
        $results = [];

        foreach ($databases as $database) {
            if (! in_array(strtolower($database), $this->disabled)) {
                $results[] = $database;
            }
        }

        return $results;
    }
}
