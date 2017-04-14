<?php
/**
 * Created by PhpStorm.
 * User: kamontat
 * Date: 4/10/2017 AD
 * Time: 10:15 PM
 */
include $_SERVER['DOCUMENT_ROOT'] . '/model/Model.php';
include $_SERVER['DOCUMENT_ROOT'] . '/helper/Limitation.php';

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
    if (!Limitation::select_all($table)) {
        return failureToJSON("\"" . $table . "\"" . " not allow to select all.");
    }

    if (isset($conditions) and count($conditions) != 0) {
        $str = "";
        for ($i = 0; $i < count($conditions); $i++) {
            $str .= $conditions[$i];
            if ($i < count($conditions) - 1) $str .= " AND ";
        }
        return connect()->queryJSON("SELECT * FROM " . $table . " WHERE " . $str);
    } else
        return connect()->queryJSON("SELECT * FROM " . $table);
}