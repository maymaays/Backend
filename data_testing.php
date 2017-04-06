<?php
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
    echo 'Not found this. <br>';
    echo 'Only `say=hello` or `say=bye` accepted';
}

if ($_GET['say'] == "hello") {
    hello();
} else
    if ($_GET['say'] == "bye") {
        goodbye();
    } else {

    }
?>