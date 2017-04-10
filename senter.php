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
echo $_SERVER['REMOTE_ADDR'];

if (
    isset($_SERVER['REMOTE_ADDR']) AND ($_SERVER['REMOTE_ADDR'] !== $_SERVER['SERVER_ADDR'])
) {
    die('Access Denied, Your IP:' . $_SERVER['REMOTE_ADDR']);
}

if (isset($_GET['query'])) {
    $query = $_GET['query'];
    $model = new DatabaseModel(true /* false */);
    $result = $model->query($query);
    echo "<pre>" . sqlToJSON($result) . "</pre>";
    $model->close();
}

// example: http://localhost:63342/ProjectTest/senter.php?_ijt=9u8f5l2hi5mege5utue6pb8jk6&query=SELECT%20*%20FROM%20test%20WHERE%20id=0 (localhost)