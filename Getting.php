<?php

include $_SERVER['DOCUMENT_ROOT'] . '/api/query_api.php';

echo selectAll("test", array("id=1", "name='net'"));

?>