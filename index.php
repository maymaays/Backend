<?php
/**
 * Created by PhpStorm.
 * User: kamontat
 * Date: 4/8/2017 AD
 * Time: 4:16 PM
 */

// http response code: https://en.wikipedia.org/wiki/List_of_HTTP_status_codes
header('Content-Type: application/json');

// $select = "SELECT * FROM test WHERE id=0";
// $insert = "INSERT INTO test (id, name, surname) VALUES (0, 'new', 'sur')";
// $delete = "DELETE FROM `test` WHERE name='new'";
// $update = "UPDATE test SET surname='new_sur' WHERE name='new'";

$method = $_SERVER['REQUEST_METHOD'];

if ($method == 'GET') {
    include 'Getting.php';
} else if ($method == 'POST') {
    include 'Posting.php';
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