<?php
/**
 * Created by PhpStorm.
 * User: kamontat
 * Date: 4/6/2017 AD
 * Time: 10:08 PM
 */

$default_tag = "<pre style=\"word-wrap: break-word; white-space: pre-wrap;\">";
$default_tag_close = "</pre>";

function toJSON(bool $success, array $array = null /* mapping array */)
{
    // $array will be like: `[ id: [1, 4, 5], name: ["first", "second"] ]` (Map<String, Object[]> java syntax)
    // real
    $string = sprintf("{\n\t\"success\": \"%s\"", $success ? "true" : "false");
    if (isset($array)) {
        foreach ($array as $key => $values) {
            $string .= ",\n\t\"" . $key . "\"" . ": [";
            foreach ($values as $value) {
                $string .= "\"" . $value . "\",";
            }
            $string = substr($string, 0, -1) . "]";
        }
    }
    return $string . "\n}";
}

/**
 * @param mysqli_result|bool $result
 * @return string json of data
 */
function sqlToJSON($result)
{
    if (is_object($result)) {
        $array = to_array($result);
        $result->free();
        return toJSON(isset($array), $array);
    } else {
        return toJSON($result);
    }
}

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
