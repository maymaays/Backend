<?php
/**
 * Created by PhpStorm.
 * User: kamontat
 * Date: 4/6/2017 AD
 * Time: 10:08 PM
 */

/**
 * @param bool $success
 * @param array|null $array
 * @return string json object (UTF-8 code ONLY)
 */
function toJSON(bool $success, array $array = null /* mapping array */)
{
    $array_success = array('success' => $success ? "true" : "false");
    if (isset($array)) {
        $result = array_merge($array_success, $array);
        return json_encode($result, JSON_PRETTY_PRINT);
    } else {
        return json_encode($array_success, JSON_PRETTY_PRINT);
    }
}

/**
 * change failure to json
 * @param $description string why fail
 * @return string failure json
 */
function failureToJSON($description = "Some error occurred.")
{
    return toJSON(false, array("message" => $description));
}

/**
 * if pass string meaning fail.
 * @param mysqli_result|bool|string $result
 * @return string json of data
 */
function sqlToJSON($result)
{
    if (is_string($result)) {
        return failureToJSON($result);
    } else if (is_object($result)) {
        $array = to_array($result);
        $result->free();
        return toJSON(isset($array), $array);
    } else {
        return toJSON($result);
    }
}

?>