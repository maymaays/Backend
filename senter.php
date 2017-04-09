<?php
/**
 * Created by PhpStorm.
 * User: kamontat
 * Date: 4/8/2017 AD
 * Time: 4:16 PM
 */
include 'Model.php';
include 'api.php';
include 'json_formating.php';

$select = "SELECT * FROM test WHERE id=0";
$insert = "INSERT INTO test (id, name, surname) VALUES (0, 'new', 'sur')";
$delete = "DELETE FROM `test` WHERE name='new'";
$update = "UPDATE test SET surname='new_sur' WHERE name='new'";


if (isset($_GET['query'])) {
    $query = $_GET['query'];
    $model = new DatabaseModel(false);
    $result = $model->query($query);
    echo "<pre>" . sqlToJSON($result) . "</pre>";

    $model->close();
}