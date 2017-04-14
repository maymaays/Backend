<?php

/**
 * check limitation of query, all method in here will return true/false so make program known is query allowed.
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
}