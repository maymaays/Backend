<?php
/**
 * Created by PhpStorm.
 * User: kamontat
 * Date: 4/10/2017 AD
 * Time: 10:15 PM
 */
include $_SERVER['DOCUMENT_ROOT'] . '/model/Model.php';

function connect()
{
    $model = new DatabaseModel(false /* true */);
    $model->connection();
    return $model;
}

/**
 * @param $table
 * @param null $conditions
 * @return string
 */
function selectAll($table, array $conditions = null)
{
    if (isset($conditions)) {
        $str = "";
        for ($i = 0; $i < count($conditions); $i++) {
            $str .= $conditions[$i];
            if ($i < count($conditions) - 1) $str .= " AND ";
        }
        echo $str;
        return addPreTag(connect()->queryJSON("SELECT * FROM " . $table . " WHERE " . $str));
    } else
        return addPreTag(connect()->queryJSON("SELECT * FROM " . $table));
}