<?php

defined('DS') or exit('No direct script access.');

class AdminerEnumTypes
{
    private $types;

    public function editInput($table, $field, $attrs, $value)
    {
        if (! in_array(strtolower(connection()->extension), ['pgsql', 'pdo_pgsql'])) {
            return;
        }

        if (is_null($this->types)) {
            $types = types();
            $this->types = [];

            foreach ($types as $type) {
                $values = get_vals("SELECT unnest(enum_range(NULL::$type))::text AS value");

                if (! empty($values) && is_array($values)) {
                    $this->types[$type] = $values;
                }
            }
        }

        if (array_key_exists($field['type'], $this->types)) {
            $options = $this->types[$field['type']];
            $options = array_combine($options, $options);
            $selected = $value;

            if ($field['null']) {
                $options = ['' => ['' => 'NULL']] + $options;

                if ($value === null && ! isset($_GET['select'])) {
                    $selected = '';
                }
            }

            if (isset($_GET['select'])) {
                $options = ['' => [-1 => lang('original')]] + $options;
            }

            return '<select$attrs>'.optionlist($options, (string) $selected, 1).'</select>';
        }
    }
}
