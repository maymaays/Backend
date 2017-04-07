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
    echo 'Not found this. Only `?say=hello` or `?say=bye` accepted';
}

if ($_GET['say'] == "hello") {
    hello();
} else if ($_GET['say'] == "bye") {
    goodbye();
} else if ($_GET['say']) {
    not_found();
    http_response_code(400);
} else {
    http_response_code(404);
}
?>