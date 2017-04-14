<?php
/**
 * Created by PhpStorm.
 * User: kamontat
 * Date: 4/10/2017 AD
 * Time: 10:15 PM
 */
include $_SERVER['DOCUMENT_ROOT'] . '/model/Model.php';
include $_SERVER['DOCUMENT_ROOT'] . '/helper/Limitation.php';

$model = null;

function connect()
{
    if (!isset($GLOBALS['model']))
        $GLOBALS['model'] = new DatabaseModel(false /* true */);
    $GLOBALS['model']->connection();
    return $GLOBALS['model'];
}

/**
 * @param $table
 * @param $conditions array|null
 * @return string
 */
function selectAll($table, array $conditions = null)
{
    if (!Limitation::select_all($table))
        return failureToJSON("\"" . $table . "\"" . " not allow to select all.");

    return select($table, array("*"), $conditions);
}

function select($table, array $columns, array $conditions = null)
{
    $col = null;
    foreach ($columns as $column) {
        if (!isset($col)) {
            $col = $column;
        } else {
            $col .= ", " . $column;
        }
    }
    if (!isset($col)) return failureToJSON("No column(s) specific.");

    if (isset($conditions) and count($conditions) != 0) {
        $str = "";
        for ($i = 0; $i < count($conditions); $i++) {
            $str .= $conditions[$i];
            if ($i < count($conditions) - 1) $str .= " AND ";
        }
        return connect()->queryJSON("SELECT " . $col . " FROM " . $table . " WHERE " . $str);
    } else
        return connect()->queryJSON("SELECT " . $col . " FROM " . $table);
}

function insert($table, array $values)
{
    $cols = connect()->getColumns($table);
    if (!isset($cols)) failureToJSON($table . " don't have any column(s).");
    else {
        $str_head_col = null;
        foreach ($cols as $col) {
            if (!isset($str_head_col)) $str_head_col = "(" . $col;
            else $str_head_col .= ", " . $col;
        }
        $str_head_col .= ")";

        $str_value_col = null;
        foreach ($values as $value) {
            if (!isset($str_value_col)) $str_value_col = "(" . $value;
            else $str_value_col .= ", " . $value;
        }
        $str_value_col .= ")";

        return connect()->queryJSON("INSERT INTO " . $table . " " . $str_head_col . " VALUES " . $str_value_col);
    }
}

