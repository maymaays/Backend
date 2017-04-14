<?php

include $_SERVER['DOCUMENT_ROOT'] . '/api/query_api.php';
include $_SERVER['DOCUMENT_ROOT'] . '/helper/Information.php';

$action = $_GET['action'];

$array = Information::get_required_parameter($action);
if (!isset($array)) {
    http_response_code(501);
    die(failureToJSON($action . " isn't implementation yet!"));
}

$str = "";
$error = false;
foreach ($array as $required) {
    if (!isset($_GET[$required])) {
        $error = true;
        $str .= "\"" . $required . "\"" . " ";
    }
}
if ($error) {
    http_response_code(400);
    die(failureToJSON($str . " is required for " . $action . " action"));
}

switch ($action) {
    case "select_all":
        selectAll($_GET[$array[0]], $_GET[$array[1]]);
        break;
    case "insert_customer":

        break;
    case "update_customer":

        break;
    case "search_customer":

        break;
    default:

        break;
}

?>