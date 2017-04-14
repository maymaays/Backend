<?php
/**
 * Created by PhpStorm.
 * User: kamontat
 * Date: 4/8/2017 AD
 * Time: 4:16 PM
 */
include 'api/json_parser.php';

// http response code: https://en.wikipedia.org/wiki/List_of_HTTP_status_codes
header('Content-Type: application/json');

// $select = "SELECT * FROM test WHERE id=0";
// $insert = "INSERT INTO test (id, name, surname) VALUES (0, 'new', 'sur')";
// $delete = "DELETE FROM `test` WHERE name='new'";
// $update = "UPDATE test SET surname='new_sur' WHERE name='new'";

$method = $_SERVER['REQUEST_METHOD'];
if (!isset($_POST['action']) and !isset($_GET['action'])) {
    http_response_code(400);
    die(failureToJSON("don't have \"action\" parse-in"));
} else {
    if ($method == 'GET') {
        include 'Getting.php';
    } else if ($method == 'POST') {
        include 'Posting.php';
    } else {
        http_response_code(405);
        die(failureToJSON($method . " not allow"));
    }
}

?>