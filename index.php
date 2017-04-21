<?php
/**
 * Created by PhpStorm.
 * User: kamontat
 * Date: 4/8/2017 AD
 * Time: 4:16 PM
 */
include "api/json_parser.php";
include "api/query_api.php";
include "api/method_api.php";
include "helper/Limitation.php";
include "helper/Information.php";

// http response code: https://en.wikipedia.org/wiki/List_of_HTTP_status_codes
header('Content-Type: application/json');

// $select = "SELECT * FROM test WHERE id=0";
// $insert = "INSERT INTO test (id, name, surname) VALUES (0, 'new', 'sur')";
// $delete = "DELETE FROM `test` WHERE name='new'";
// $update = "UPDATE test SET surname='new_sur' WHERE name='new'";

// print_r($_SERVER); // debug tool
$method = $_SERVER['REQUEST_METHOD'];
$actual_array = [];
if ($method == 'GET') {
    $actual_array = $_GET;
} else if ($method == 'POST') {
    $actual_array = $_POST;
} else {
    http_response_code(405);
    die(failureToJSON($method . " not allow"));
}

if (count($actual_array) == 0 or count($actual_array) == 1) {
    die(failureToJSON("If you don't know how to use this api, go to https://api.kamontat.me/docs to learn it."));
}

// print_r($input); // debug tool

if (!isset($actual_array['action'])) {
    http_response_code(400);
    die(failureToJSON("don't have (action) parse-in"));
}

$action = $actual_array['action'];
$expected_array = Information::get_required_key($action);

// first element of get_required_parameter() is expected method
if (array_shift($expected_array) != $method) {
    http_response_code(405);
    die($action . " not allow to sent by " . $method . " method.");
}

$str = Limitation::is_required($method, $expected_array, $actual_array);
if (is_string($str)) {
    http_response_code(400);
    die(failureToJSON($str));
}

// debug tool
// print_r($expected_array);
// print_r($actual_array);

$raw_array = fetch_required_to_array($expected_array, $actual_array);

switch ($action) {
    case "select":
        echo select($raw_array[0], $raw_array[1], $raw_array[2]);
        break;
    case "select_all":
        echo selectAll($raw_array[0], $raw_array[1]);
        break;
    case "insert_customer":
        echo insert_customer($raw_array);
        break;
    case "update_customer":
        echo update_customer($raw_array[2], $raw_array[3], merge_array($raw_array[0], $raw_array[1]));
        break;
    case "search_customer":
        echo search_customer($raw_array[0], $raw_array[1]);
        break;
    case "booking":

}

?>
