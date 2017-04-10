<?php
// header('Access-Control-Allow-Origin: *');

function hello()
{
    echo 'hello world';
}

function goodbye()
{
    echo 'good bye';
}

function not_found()
{
    echo 'Not found this. Only `hello` or `bye` accepted';
}

echo $_SERVER;

if (
    isset($_SERVER['REMOTE_ADDR']) AND ($_SERVER['REMOTE_ADDR'] !== $_SERVER['SERVER_ADDR'])
) {
    die('Access Denied, Your IP:' . $_SERVER['REMOTE_ADDR']);
}


if (isset($_GET['say'])) {
    $say = $_GET['say'];

    if ($say == "hello") {
        hello();
    } else if ($say == "bye") {
        goodbye();
    } else {
        not_found();
        http_response_code(400);
    }
} else {
    http_response_code(405);
}
?>