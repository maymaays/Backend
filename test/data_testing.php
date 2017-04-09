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