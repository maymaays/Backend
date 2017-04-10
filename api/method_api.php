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

function addPreTag($string)
{
    return "<pre>" . $string . "</pre>";
}