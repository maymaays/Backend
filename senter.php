<?php
/**
 * Created by PhpStorm.
 * User: kamontat
 * Date: 4/8/2017 AD
 * Time: 4:16 PM
 */
include 'model/Model.php';
include 'api/api.php';
include 'api/json_formating.php';

// $select = "SELECT * FROM test WHERE id=0";
// $insert = "INSERT INTO test (id, name, surname) VALUES (0, 'new', 'sur')";
// $delete = "DELETE FROM `test` WHERE name='new'";
// $update = "UPDATE test SET surname='new_sur' WHERE name='new'";

// print_r($_SERVER);

if (isset($_GET['query'])) {
    $query = $_GET['query'];
    if (strpos($query, "DELETE") === true or strpos($query, "UPDATE") === true or strpos($query, "INSERT") === true) {
        die("Cannot `insert`, `delete`, `update` query");
    }
    
    $model = new DatabaseModel(false /* true */);
    $result = $model->query($query);
    echo "<pre>" . sqlToJSON($result) . "</pre>";
    $model->close();
} else {
    http_response_code(400);
}

// http response code: https://en.wikipedia.org/wiki/List_of_HTTP_status_codes

// example: http://localhost:63342/ProjectTest/senter.php?_ijt=9u8f5l2hi5mege5utue6pb8jk6&query=SELECT%20*%20FROM%20test%20WHERE%20id=0 (localhost)