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

$method = $_SERVER['REQUEST_METHOD'];
$input = [];
if ($method == 'GET') {
    $input = $_GET;
} else if ($method == 'POST') {
    $input = $_POST;
} else {
    http_response_code(405);
    die(failureToJSON($method . " not allow"));
}

if (!isset($input['action'])) {
    http_response_code(400);
    die(failureToJSON("don't have (action) parse-in"));
}

$action = $input['action'];
$array = Information::get_required_parameter($action);

$str = Limitation::is_required($method, $array, $input);
if (is_string($str)) {
    http_response_code(400);
    die(failureToJSON($str));
}


switch ($action) {
    case "select_all":
        echo selectAll($input[$array[0]], $input[$array[1]]);
        break;
    case "insert_customer":
        $arr = [];
        foreach ($array as $item) {
            $arr[] = $input[$item];
        }
        // print_r($arr);
        echo insert_customer($arr);
        break;
}

?>