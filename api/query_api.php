<?php
/**
 * Created by PhpStorm.
 * User: kamontat
 * Date: 4/10/2017 AD
 * Time: 10:15 PM
 */
include $_SERVER['DOCUMENT_ROOT'] . '/model/Model.php';

$model = null;

/**
 * try to connect
 * @return DatabaseModel|mixed
 */
function connect()
{
    if (!isset($GLOBALS['model']))
        $GLOBALS['model'] = new DatabaseModel(false /* true */);
    $GLOBALS['model']->connection();
    return $GLOBALS['model'];
}

/**
 * select columns from table with/without condition
 * @param $table
 * @param array $columns columns to select (if want to select all please use selectAll instead)
 * @param array|string $conditions pass string or null if don't want condition
 * @return string json
 */
function select($table, array $columns, $conditions = "")
{
    $col = convert_array($columns, ", ");
    if (!isset($col)) return failureToJSON("No column(s) specific.");

    if (isset($conditions) and !is_string($conditions)) {
        $str = convert_array($conditions, " AND ");
        if ($str === "")
            return connect()->queryJSON("SELECT " . $col . " FROM " . $table);
        else
            return connect()->queryJSON("SELECT " . $col . " FROM " . $table . " WHERE " . $str);
    } else
        return connect()->queryJSON("SELECT " . $col . " FROM " . $table);
}

/**
 * select all (only use for allow table Limitation::select_all() method)
 *
 * @param $table
 * @param $conditions array|null condition like id=12 or name='something'
 * @return string json
 */
function selectAll($table, array $conditions = null)
{
    if (!Limitation::select_all($table))
        return failureToJSON("\"" . $table . "\"" . " not allow to select all.");

    return select($table, array("*"), $conditions);
}

/**
 * insert new data/row to table
 * @param $table
 * @param array $values insert value (no need to map but sequential must like table)
 * @return string json
 */
function insert($table, array $values)
{
    $cols = connect()->getColumns($table);
    if (is_string($cols)) return failureToJSON($table . " with error " . $cols);
    else {
        $str_head_col = convert_array($cols, ", ", " (", ")");
        $str_value_col = convert_array($values, ", ", "(", ")");
        if (!isset($str_head_col) or !isset($str_value_col)) return failureToJSON("Don't have insert head(s) or value(s)");

        return connect()->queryJSON("INSERT INTO " . $table . $str_head_col . " VALUES " . $str_value_col);
    }
}

/**
 * update row in table
 * @param $table
 * @param array $sets update param like name='new name' or code=10001
 * @param array|string $conditions warning, it's can be null BUT the update will update __all__ in table
 * @return string json
 */
function update($table, array $sets, $conditions = "")
{
    $set_str = convert_array($sets, ", ");
    if (!isset($set_str)) return failureToJSON("No column(s) specific.");

    if (isset($conditions) and !is_string($conditions)) {
        $condition_str = convert_array($conditions, " AND ");
        if ($condition_str === "")
            return connect()->queryJSON("UPDATE " . $table . " SET " . $set_str);
        else
            return connect()->queryJSON("UPDATE " . $table . " SET " . $set_str . " WHERE " . $condition_str);
    } else
        return connect()->queryJSON("UPDATE " . $table . " SET " . $set_str);
}

// new implementation

function insert_customer(array $new_values)
{
    return insert("CustomerDetail", $new_values);
}