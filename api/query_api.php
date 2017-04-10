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
 * @param null $condition
 * @return string
 */
function selectAll($table, $condition = null)
{
    if (isset($condition))
        return addPreTag(connect()->queryJSON("SELECT * FROM " . $table . " WHERE " . $condition));
    else
        return addPreTag(connect()->queryJSON("SELECT * FROM " . $table));
}