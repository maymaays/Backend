<?php

/**
 * Created by PhpStorm.
 * User: kamontat
 * Date: 4/8/2017 AD
 * Time: 3:59 PM
 */
class DatabaseModel
{
    /**
     * @var bool
     */
    public $PRODUCTION = false; /* true */

    /**
     * @var mysqli
     */
    public $database;

    /**
     * DatabaseModel constructor.
     * @param bool $PRODUCTION
     */
    public function __construct($PRODUCTION)
    {
        $this->PRODUCTION = $PRODUCTION;
    }

    public function connection()
    {
        $ini_array = parse_ini_file("constants.ini");
        if (!$this->PRODUCTION) {
            // precondition: need to add private/public key for ssh (link: https://github.com/Database-Systems-For-SKE/Planning-Design#important)
            shell_exec("ssh -fNg -L " . $ini_array['default_sql_port'] . ":" . $ini_array['local_host'] . ":" . $ini_array['default_sql_port'] . " " . $ini_array['root_user'] . "@" . $ini_array['ssh_host'] . " sleep 60 >> logfile");
        }

        $this->database = mysqli_connect($ini_array['local_host'], $ini_array['database_manager'], $ini_array['database_password'], $ini_array['database_name']);
        if (mysqli_connect_errno()) die("to connect to MySQL: " . mysqli_connect_error());
        if (!isset($this->database)) die("Not database created.");
    }

    /**
     *
     *
     * @param string $q
     * @return mysqli_result|boolean|string For successful SELECT, SHOW, DESCRIBE or
     * EXPLAIN queries <b>mysqli_query</b> will return
     * a <b>mysqli_result</b> object.For other successful queries <b>mysqli_query</b> will
     * return true and string if on failure.
     */
    private function query(string $q)
    {
        // first test, if not exist connect again
        if (!isset($this->database)) {
            $this->connection();
        }

        mysqli_set_charset($this->database, 'utf8');
        if ($result = $this->database->query($q)) {
            if (is_bool($result) and $result == false) {
                return $this->database->error;
            } else {
                return $result;
            }
        } else
            return $this->database->error;
    }

    /**
     * query and return result as json format
     * @param string $q query
     * @return string json file
     */
    public function queryJSON(string $q)
    {
        // echo $q; // debug tool
        return sqlToJSON($this->query($q));
    }

    /**
     * @param $table string input table
     * @return array|string array if had column in table, otherwise, return string description
     */
    public function getColumns($table)
    {
        $json = $this->queryJSON("SHOW COLUMNS FROM " . $table);
        $json_array = json_decode($json, true);
        if ($json_array['success'] === "true") {
            return $json_array['Field'];
        } else {
            return $json_array['failure'];
        }
    }

    /**
     * call when finish only
     */
    function close()
    {
        $this->database->close();
    }
}
