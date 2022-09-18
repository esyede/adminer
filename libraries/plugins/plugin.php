<?php

class AdminerPlugin extends Adminer
{
    public $plugins;

    public function __construct(array $plugins = [])
    {
        if (empty($plugins)) {
            $classes = get_declared_classes();
            $plugins = [];

            foreach ($classes as $class) {
                if (preg_match('~^Adminer.~i', $class)
                && strcasecmp($this->_findRootClass($class), 'Adminer')) {
                    $plugins[$class] = new $class();
                }
            }
        }

        $this->plugins = $plugins;
    }

    public function _findRootClass($class)
    {
        $res = null;

        do {
            $res = $class;
        } while ($class = get_parent_class($class));

        return $res;
    }

    public function _callParent($fn, $args)
    {
        return call_user_func_array(['parent', $fn], $args);
    }

    public function _applyPlugin($fn, $args)
    {
        $res = null;

        foreach ($this->plugins as $obj) {
            if (method_exists($obj, $fn)) {
                switch (count($args)) {
                    case 0: $res = $obj->{$fn}(); break;
                    case 1: $res = $obj->{$fn}($args[0]); break;
                    case 2: $res = $obj->{$fn}($args[0], $args[1]); break;
                    case 3: $res = $obj->{$fn}($args[0], $args[1], $args[2]); break;
                    case 4: $res = $obj->{$fn}($args[0], $args[1], $args[2], $args[3]); break;
                    case 5: $res = $obj->{$fn}($args[0], $args[1], $args[2], $args[3], $args[4]); break;
                    case 6: $res = $obj->{$fn}($args[0], $args[1], $args[2], $args[3], $args[4], $args[5]); break;
                    default: trigger_error('Too many parameters.', E_USER_WARNING);
                }

                if ($res !== null) {
                    return $res;
                }
            }
        }

        return $this->_callParent($fn, $args);
    }

    public function _appendPlugin($fn, $args)
    {
        $res = $this->_callParent($fn, $args);

        foreach ($this->plugins as $obj) {
            if (method_exists($obj, $fn)) {
                $value = call_user_func_array([$obj, $fn], $args);

                if ($value) {
                    $res += $value;
                }
            }
        }

        return $res;
    }

    public function dumpFormat()
    {
        return $this->_appendPlugin(__FUNCTION__, func_get_args());
    }

    public function dumpOutput()
    {
        return $this->_appendPlugin(__FUNCTION__, func_get_args());
    }

    public function editRowPrint($table, $fields, $row, $update)
    {
        return $this->_appendPlugin(__FUNCTION__, func_get_args());
    }

    public function editFunctions($field)
    {
        return $this->_appendPlugin(__FUNCTION__, func_get_args());
    }

    public function name()
    {
        return $this->_applyPlugin(__FUNCTION__, func_get_args());
    }

    public function credentials()
    {
        return $this->_applyPlugin(__FUNCTION__, func_get_args());
    }

    public function connectSsl()
    {
        return $this->_applyPlugin(__FUNCTION__, func_get_args());
    }

    public function permanentLogin($create = false)
    {
        return $this->_applyPlugin(__FUNCTION__, func_get_args());
    }

    public function bruteForceKey()
    {
        return $this->_applyPlugin(__FUNCTION__, func_get_args());
    }

    public function serverName($server)
    {
        return $this->_applyPlugin(__FUNCTION__, func_get_args());
    }

    public function database()
    {
        return $this->_applyPlugin(__FUNCTION__, func_get_args());
    }

    public function schemas()
    {
        return $this->_applyPlugin(__FUNCTION__, func_get_args());
    }

    public function databases($flush = true)
    {
        return $this->_applyPlugin(__FUNCTION__, func_get_args());
    }

    public function queryTimeout()
    {
        return $this->_applyPlugin(__FUNCTION__, func_get_args());
    }

    public function headers()
    {
        return $this->_applyPlugin(__FUNCTION__, func_get_args());
    }

    public function csp()
    {
        return $this->_applyPlugin(__FUNCTION__, func_get_args());
    }

    public function head()
    {
        return $this->_applyPlugin(__FUNCTION__, func_get_args());
    }

    public function css()
    {
        return $this->_applyPlugin(__FUNCTION__, func_get_args());
    }

    public function loginForm()
    {
        return $this->_applyPlugin(__FUNCTION__, func_get_args());
    }

    public function loginFormField($name, $heading, $value)
    {
        return $this->_applyPlugin(__FUNCTION__, func_get_args());
    }

    public function login($login, $password)
    {
        return $this->_applyPlugin(__FUNCTION__, func_get_args());
    }

    public function tableName($tableStatus)
    {
        return $this->_applyPlugin(__FUNCTION__, func_get_args());
    }

    public function fieldName($field, $order = 0)
    {
        return $this->_applyPlugin(__FUNCTION__, func_get_args());
    }

    public function selectLinks($tableStatus, $set = '')
    {
        return $this->_applyPlugin(__FUNCTION__, func_get_args());
    }

    public function foreignKeys($table)
    {
        return $this->_applyPlugin(__FUNCTION__, func_get_args());
    }

    public function backwardKeys($table, $tableName)
    {
        return $this->_applyPlugin(__FUNCTION__, func_get_args());
    }

    public function backwardKeysPrint($backwardKeys, $row)
    {
        return $this->_applyPlugin(__FUNCTION__, func_get_args());
    }

    public function selectQuery($query, $start, $failed = false)
    {
        return $this->_applyPlugin(__FUNCTION__, func_get_args());
    }

    public function sqlCommandQuery($query)
    {
        return $this->_applyPlugin(__FUNCTION__, func_get_args());
    }

    public function rowDescription($table)
    {
        return $this->_applyPlugin(__FUNCTION__, func_get_args());
    }

    public function rowDescriptions($rows, $foreignKeys)
    {
        return $this->_applyPlugin(__FUNCTION__, func_get_args());
    }

    public function selectLink($val, $field)
    {
        return $this->_applyPlugin(__FUNCTION__, func_get_args());
    }

    public function selectVal($val, $link, $field, $original)
    {
        return $this->_applyPlugin(__FUNCTION__, func_get_args());
    }

    public function editVal($val, $field)
    {
        return $this->_applyPlugin(__FUNCTION__, func_get_args());
    }

    public function tableStructurePrint($fields)
    {
        return $this->_applyPlugin(__FUNCTION__, func_get_args());
    }

    public function tableIndexesPrint($indexes)
    {
        return $this->_applyPlugin(__FUNCTION__, func_get_args());
    }

    public function selectColumnsPrint($select, $columns)
    {
        return $this->_applyPlugin(__FUNCTION__, func_get_args());
    }

    public function selectSearchPrint($where, $columns, $indexes)
    {
        return $this->_applyPlugin(__FUNCTION__, func_get_args());
    }

    public function selectOrderPrint($order, $columns, $indexes)
    {
        return $this->_applyPlugin(__FUNCTION__, func_get_args());
    }

    public function selectLimitPrint($limit)
    {
        return $this->_applyPlugin(__FUNCTION__, func_get_args());
    }

    public function selectLengthPrint($text_length)
    {
        return $this->_applyPlugin(__FUNCTION__, func_get_args());
    }

    public function selectActionPrint($indexes)
    {
        return $this->_applyPlugin(__FUNCTION__, func_get_args());
    }

    public function selectCommandPrint()
    {
        return $this->_applyPlugin(__FUNCTION__, func_get_args());
    }

    public function selectImportPrint()
    {
        return $this->_applyPlugin(__FUNCTION__, func_get_args());
    }

    public function selectEmailPrint($emailFields, $columns)
    {
        return $this->_applyPlugin(__FUNCTION__, func_get_args());
    }

    public function selectColumnsProcess($columns, $indexes)
    {
        return $this->_applyPlugin(__FUNCTION__, func_get_args());
    }

    public function selectSearchProcess($fields, $indexes)
    {
        return $this->_applyPlugin(__FUNCTION__, func_get_args());
    }

    public function selectOrderProcess($fields, $indexes)
    {
        return $this->_applyPlugin(__FUNCTION__, func_get_args());
    }

    public function selectLimitProcess()
    {
        return $this->_applyPlugin(__FUNCTION__, func_get_args());
    }

    public function selectLengthProcess()
    {
        return $this->_applyPlugin(__FUNCTION__, func_get_args());
    }

    public function selectEmailProcess($where, $foreignKeys)
    {
        return $this->_applyPlugin(__FUNCTION__, func_get_args());
    }

    public function selectQueryBuild($select, $where, $group, $order, $limit, $page)
    {
        return $this->_applyPlugin(__FUNCTION__, func_get_args());
    }

    public function messageQuery($query, $time, $failed = false)
    {
        return $this->_applyPlugin(__FUNCTION__, func_get_args());
    }

    public function editInput($table, $field, $attrs, $value)
    {
        return $this->_applyPlugin(__FUNCTION__, func_get_args());
    }

    public function editHint($table, $field, $value)
    {
        return $this->_applyPlugin(__FUNCTION__, func_get_args());
    }

    public function processInput($field, $value, $fn = '')
    {
        return $this->_applyPlugin(__FUNCTION__, func_get_args());
    }

    public function dumpDatabase($db)
    {
        return $this->_applyPlugin(__FUNCTION__, func_get_args());
    }

    public function dumpTable($table, $style, $is_views = 0)
    {
        return $this->_applyPlugin(__FUNCTION__, func_get_args());
    }

    public function dumpData($table, $style, $query)
    {
        return $this->_applyPlugin(__FUNCTION__, func_get_args());
    }

    public function dumpFilename($identifier)
    {
        return $this->_applyPlugin(__FUNCTION__, func_get_args());
    }

    public function dumpHeaders($identifier, $multi_table = false)
    {
        return $this->_applyPlugin(__FUNCTION__, func_get_args());
    }

    public function importServerPath()
    {
        return $this->_applyPlugin(__FUNCTION__, func_get_args());
    }

    public function homepage()
    {
        return $this->_applyPlugin(__FUNCTION__, func_get_args());
    }

    public function navigation($missing)
    {
        return $this->_applyPlugin(__FUNCTION__, func_get_args());
    }

    public function databasesPrint($missing)
    {
        return $this->_applyPlugin(__FUNCTION__, func_get_args());
    }

    public function tablesPrint($tables)
    {
        return $this->_applyPlugin(__FUNCTION__, func_get_args());
    }
}
