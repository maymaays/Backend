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
        // IP address
        $host_ssh = "139.59.96.74";
        $local = "127.0.0.1";
        // user
        $user_root = "root";
        // password
        $pass_ssh = "dc647eb65e6711e155375218212b3964";
        $pass_db = "bdaf31f7f68f9f12ee893e106579764164e2dcda1a0dd4be";
        // database
        $database = 'HotelManagement';
        // port
        $default_sql_port = 3306;

        if (!$this->PRODUCTION) {
            // precondition: need to add private/public key for ssh (link: https://github.com/Database-Systems-For-SKE/Planning-Design#important)
            shell_exec("ssh -fNg -L " . $default_sql_port . ":" . $local . ":" . $default_sql_port . " " . $user_root . "@" . $host_ssh . " sleep 60 >> logfile");
        }

        $this->database = mysqli_connect($local, $user_root, $pass_db, $database);
        if (mysqli_connect_errno()) die("to connect to MySQL: " . mysqli_connect_error());
        if (!isset($this->database)) die("Not database created.");
    }

    public function query(string $q)
    {
        // first test, if not exist connect again
        if (!isset($this->database)) {
            $this->connection();
        }
        // still not exist, die
        if (!isset($this->database)) {
            die("Not database created.");
        }
        mysqli_set_charset($this->database, 'utf8');
        if ($result = $this->database->query($q)) {
            return $result;
        } else
            die("Query Error.");
    }

    // call when finish only
    function close()
    {
        $this->database->close();
    }
}