<?php
function hello()
{
    echo 'hello world';
}

function goodbye()
{
    echo 'good bye';
}

if ($_GET['say'] == "hello") {
    hello();
}
if ($_GET['say'] == "bye") {
    goodbye();
}
?>