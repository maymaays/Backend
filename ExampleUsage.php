<?php
/**
 * Created by PhpStorm.
 * User: kamontat
 * Date: 4/8/2017 AD
 * Time: 4:16 PM
 */
include 'Model.php';
include 'api.php';

$model = new DatabaseModel(false);

$result = $model->query("SELECT * FROM test WHERE id=0");

$array = array();

// Procedural style
while ($row = $result->fetch_assoc()) {
    if (!$row) die("no row result");

    if (!$array)
        $array = $row;
    else
        $array = merge_map($array, $row);

    // print_r($value);
    // echo "<br>";

    // foreach ($row as $element) {
    // echo $element;
    // }
    // printf("id=%s  name=%s  surname=%s<br>", $row[0], $row[1], $row[2]);
}
// print_r($array);
foreach ($array as $key => $values) {
    echo "key: " . $key . "[";
    foreach ($values as $key1 => $value) {
        echo $key1 . "->" . $value . ", ";
    }
    echo "]<br>";
}

$result->free();
// close everything
$model->close();