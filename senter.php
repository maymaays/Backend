<?php
/**
 * Created by PhpStorm.
 * User: kamontat
 * Date: 4/8/2017 AD
 * Time: 4:16 PM
 */
include 'api/method_api.php';
include 'api/json_parser.php';
include 'api/query_api.php';

header('Content-Type: application/json');
// http response code: https://en.wikipedia.org/wiki/List_of_HTTP_status_codes


// $select = "SELECT * FROM test WHERE id=0";
// $insert = "INSERT INTO test (id, name, surname) VALUES (0, 'new', 'sur')";
// $delete = "DELETE FROM `test` WHERE name='new'";
// $update = "UPDATE test SET surname='new_sur' WHERE name='new'";

$method = $_SERVER['REQUEST_METHOD'];

if ($method == 'GET') {

    include 'Getting.php';
    // echo selectAll("test", array("id=0", "name=net", "surname=ten"));

} else if ($method == 'POST') {

    include 'Posting.php';
    // echo selectAll("test", array("id=0", "name=net", "surname=ten"));

}

// example
/*
if (!isset($_GET['action']) or strtolower($_GET['action']) != "select") {
    http_response_code(400);
    die("SELECT only.");
}

if (isset($_GET['table']) and isset($_GET['condition'])) {
    echo selectAll($_GET['table'], $_GET['condition']);
} else if (isset($_GET['table']) and !isset($_GET['condition'])) {
    echo selectAll($_GET['table']);
} else {
    http_response_code(404);
    die("Error no searching table.");
}
*/


// example: http://localhost:63342/ProjectTest/senter.php?_ijt=9u8f5l2hi5mege5utue6pb8jk6&query=SELECT%20*%20FROM%20test%20WHERE%20id=0 (localhost)