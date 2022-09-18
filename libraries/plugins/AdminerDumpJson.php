<?php

class AdminerDumpJson
{
    public $database = false;

    public function dumpFormat()
    {
        return ['json' => 'JSON'];
    }

    public function dumpTable($table, $style, $is_views = 0)
    {
        if ($_POST['format'] === 'json') {
            return true;
        }
    }

    public function _database()
    {
        echo '}'.PHP_EOL;
    }

    public function dumpData($table, $style, $query)
    {
        if ($_POST['format'] === 'json') {
            if ($this->database) {
                echo ','.PHP_EOL;
            } else {
                $this->database = true;
                echo '{'.PHP_EOL;
                register_shutdown_function([$this, '_database']);
            }

            $result = connection()->query($query, 1);

            if ($result) {
                echo '"'.addcslashes($table, "\r\n\"\\").'": ['.PHP_EOL;
                $first = true;

                while ($row = $result->fetch_assoc()) {
                    echo($first ? '' : ', ');
                    $first = false;

                    foreach ($row as $key => $val) {
                        json_row($key, $val);
                    }

                    json_row('');
                }

                echo ']';
            }
            return true;
        }
    }

    public function dumpHeaders($identifier, $multi_table = false)
    {
        if ($_POST['format'] === 'json') {
            header('Content-Type: application/json; charset=utf-8');
            return 'json';
        }
    }
}
