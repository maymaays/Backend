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
 * @param array|string $col columns to select (if want to select all please use selectAll instead)
 * @param array|string $conditions pass string or null if don't want condition
 * @return string json
 */
function select($table, $col, $conditions = "")
{
    // convert column to array
    $columns = array();
    if (is_string($col)) $columns = array($col);
    else $columns = $col;

    $col_str = convert_array($columns, ", ");
    if (!isset($col_str)) return failureToJSON("No column(s) specific.");

    if (!isset($conditions)) return connect()->queryJSON("SELECT " . $col_str . " FROM " . $table);
    $condition_str = "";
    if (is_array($conditions))
        $condition_str = convert_array($conditions, " AND ");
    else if (is_string($conditions))
        $condition_str = $conditions;

    if ($condition_str === "")
        return connect()->queryJSON("SELECT " . $col_str . " FROM " . $table);

    return connect()->queryJSON("SELECT " . $col_str . " FROM " . $table . " WHERE " . $condition_str);
}

/**
 * select all (only use for allow table Limitation::select_all() method)
 *
 * @param $table
 * @param $conditions array|string condition like id=12 or name='something'
 * @return string json
 */
function selectAll($table, $conditions = "")
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
    // no condition
    if (!isset($conditions)) return connect()->queryJSON("UPDATE " . $table . " SET " . $set_str);
    // convert condition to string
    $condition_str = "";
    if (is_array($conditions))
        $condition_str = convert_array($conditions, " AND ");
    else if (is_string($conditions))
        $condition_str = $conditions;

    if ($condition_str === "")
        return connect()->queryJSON("UPDATE " . $table . " SET " . $set_str);

    return connect()->queryJSON("UPDATE " . $table . " SET " . $set_str . " WHERE " . $condition_str);
}

// new implementation

function insert_customer(array $new_values)
{
    return insert("CustomerDetail", $new_values);
}

function update_customer($email, $pass, array $sets)
{
    $json = json_decode(search_customer($email, $pass), true);
    return update("CustomerDetail", $sets, "customerID=" . $json['customerID']);
}

function booking($email, $pass, $night, $in, $out, $roomID)
{
    // not implement yet!
}

/**
 * get id of email and password
 * @param $email
 * @param $pass
 * @return null|int|string null=>doesn't have id for this email&password, int=>id of email&password, string=>cause error (json format)
 */
function get_customer_id($email, $pass)
{
    $json = selectAll("CustomerDetail", array("email='" . $email . "'", "password='" . $pass . "'"));
    $array = json_decode($json, true);
    if ($array['success'] == "false")
        return $json;
    else
        return array_key_exists("customerID", $array) ? $array['customerID'] : null;
}

function search_customer(string $email, string $password)
{
    $result = get_customer_id($email, $password);
    if (!is_string($result)) return $result;
    // else if (!isset($result)) return toJSON(true, array("customerID" => "Not found")); // search and nothing found
    return $result;
}

function searchRoom()
{
    // not implement yet!
}