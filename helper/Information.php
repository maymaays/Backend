<?php

/**
 * Created by PhpStorm.
 * User: kamontat
 * Date: 4/14/2017 AD
 * Time: 1:35 PM
 */
class Information
{
    const array = "array";
    const string = "string";
    const int = "integer";
    const encrypt = "encrypt";
    const unknown = "unknown";

    /**
     * First element is expected/required method, and other is all key that should pass with action.
     * @param $action
     * @return array
     */
    public static function get_required_key($action)
    {
        switch ($action) {
            case "select":
                return array("GET", "table_s", "columns_as", "conditions_as");
                break;
            case "select_all":
                return array("GET", "table_s", "conditions_as");
                break;
            case "insert_customer":
                return array("POST", "first_s", "last_s", "address_s", "email_s", "password");
                break;
            case "update_customer":
                return array("POST", "fields_a", "new_values_a", "password");
                break;
            case "search_customer":
                return array("POST", "email_s", "password");
                break;
            default:
                http_response_code(501);
                die(failureToJSON($action . " isn't implementation yet!"));
        }
    }

    /**
     * @param string $parameter
     * @return array
     */
    public static function get_class_of($parameter)
    {
        // is password
        if ($parameter == 'password') return array(Information::encrypt);
        $arr = explode("_", $parameter);
        $end_arr = strval(end($arr));
        // not match anything
        if ($end_arr === false) return array(Information::unknown);
        $return_arr = [];
        if (strpos($end_arr, 'a') !== false) $return_arr[] = Information::array;
        if (strpos($end_arr, 'i') !== false) $return_arr[] = Information::int;
        if (strpos($end_arr, 's') !== false) $return_arr[] = Information::string;
        return $return_arr;
    }
}