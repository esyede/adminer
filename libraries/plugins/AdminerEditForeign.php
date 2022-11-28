<?php

defined('DS') or exit('No direct script access.');

class AdminerEditForeign
{
    private $limit;

    public function __construct($limit = 0)
    {
        $this->limit = $limit;
    }

    public function editInput($table, $field, $attrs, $value)
    {
        static $tables = [];
        static $values = [];

        $keys = &$tables[$table];

        if ($keys === null) {
            $keys = column_foreign_keys($table);
        }

        foreach ((array) $keys[$field['field']] as $key) {
            if (count($key['source']) == 1) {
                $target = $key['table'];
                $id = $key['target'][0];
                $options = &$values[$target][$id];

                if (! $options) {
                    $column = idf_escape($id);

                    if (preg_match('~binary~', $field['type'])) {
                        $column = 'HEX('.$column.')';
                    }

                    $options = ['' => ''] + get_vals('SELECT '.$column.' FROM '.table($target)
                       .' ORDER BY 1'.($this->limit ? ' LIMIT '.($this->limit + 1) : ''));

                    if ($this->limit && (count($options) - 1) > $this->limit) {
                        return;
                    }
                }

                return '<select'.$attrs.'>'.optionlist($options, $value).'</select>';
            }
        }
    }
}
