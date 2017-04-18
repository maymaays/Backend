<?php
/**
 * Created by PhpStorm.
 * User: kamontat
 * Date: 4/5/2017 AD
 * Time: 4:21 PM
 */


// merge 2 map arr
function merge_map($main, $arr)
{
    $result = array_combine(array_keys($main), array_fill(0, count($main), null));
    // $i = 0;
    foreach ($main as $key => $value) {
        if (is_array($value))
            $result[$key] = $value;
        else
            $result[$key][] = $value;
    }

    foreach ($main as $key => $value) {
        $key_exist = array_key_exists($key, $arr);
        if ($key_exist)
            $result[$key][] = $arr[$key];
    }
    // clean array
    array_walk($result, create_function('&$v', '$v = (count($v) == 1)? array_pop($v): $v;'));
    return $result;
}

function to_array(mysqli_result $result)
{
    $array = array();
    while ($row = $result->fetch_assoc()) {
        if (!$row) return null;

        if (!$array)
            $array = $row;
        else
            $array = merge_map($array, $row);
    }
    return $array;
}


/**
 * @param array $arr not null
 * @param string $between
 * @param string|null $first
 * @param string|null $last
 * @return string converted array
 */
function convert_array(array $arr, $between, $first = null, $last = null)
{
    $str = null;
    foreach ($arr as $item) {
        if (!isset($str)) {
            $str = isset($first) ? $first . $item : $item;
        } else {
            $str .= $between . $item;
        }
    }
    if (isset($last) and isset($str))
        $str .= $last;
    return $str;
}

/**
 * get value from actual by expected key
 * @param array $expected_key
 * @param array $actual
 * @return array
 */
function fetch_required_to_array(array $expected_key, array $actual)
{
    $arr = [];
    foreach ($expected_key as $item) {
        if (!Limitation::is_allow_type($item, $actual[$item])) {
            http_response_code(406);
            die(failureToJSON($item . " must be " . convert_array(Information::get_class_of($item), ", ") . " type."));

        }
        $arr[] = $actual[$item];
    }
    // array_shift($arr); // avoid empty element at first
    return $arr;
}