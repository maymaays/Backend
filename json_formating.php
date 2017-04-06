<?php
/**
 * Created by PhpStorm.
 * User: kamontat
 * Date: 4/6/2017 AD
 * Time: 10:08 PM
 */

$test = "key: id[0->0, 1->0, 2->0, 3->0, 4->0, ]
key: name[0->1, 1->1, 2->1, 3->net, 4->ไทยนะ, ]
key: surname[0->2, 1->2, 2->2, 3->ten, 4->ก็ไทยไง, ]";

$default_tag = "<pre style=\"word-wrap: break-word; white-space: pre-wrap;\">";
$default_tag_close = "</pre>";

function toJSON(bool $success, $keys, $arr_values)
{
    // real
    $string = sprintf("{\"success\": \"%s\",", $success ? "true" : "false");
    
    // mock
    return sprintf("{\n\t\"success\": \"%s\",
\t\"some\":\"thing\",
\t\"new\":\"thing\",
\t\"old\":\"thing\"\n}", $success ? "true" : "false");
}


$x = toJSON(true, array(), array());
echo $default_tag . $x . $default_tag_close;


?>


<html>
<style type="text/css">
    pre {
        -moz-tab-size: 2; /* Firefox 4+ */
        -o-tab-size: 2; /* Opera 11.5 & 12.1 only */
        tab-size: 2; /* Chrome 21+, Safari 6.1+, Opera 15+ */
    }
</style>
</html>
