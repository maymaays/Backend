<?php

/**
 * check limitation of query, all method in here will return 2 way allow/OK or Not OK/error occurred, so this will make program known allowed passing/ok or not.
 *
 * Created by PhpStorm.
 *
 * User: kamontat
 *
 * Date: 4/14/2017 AD
 *
 * Time: 12:42 PM
 */
class Limitation
{
    /**
     * @param string $table
     * @return true, if table is allow; otherwise, return false
     */
    public static function select_all($table)
    {
        return $table === "Hotel" or $table === "Room" or $table === "RoomType" or $table === "Facilities";
    }

    /**
     * @param array $required get from Information::get_required_parameter() method
     * @param array $actual get from $_GET, $_POST etc.
     * @return false|string string when have error occurred.
     */
    public static function is_required(array $required, array $actual)
    {
        $str = "";
        $error = false;
        foreach ($required as $req) {
            if (!isset($actual[$req])) {
                $error = true;
                $str .= "`" . $req . "`" . " ";
            }
        }

        return $error ? $str : false;
    }
}