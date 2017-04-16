<?php

/**
 * Created by PhpStorm.
 * User: kamontat
 * Date: 4/14/2017 AD
 * Time: 1:35 PM
 */
class Information
{

    /**
     * First element is expected/required method, and other is all key that should pass with action.
     * @param $action
     * @return array
     */
    public static function get_required_parameter($action)
    {
        switch ($action) {
            case "select_all":
                return array("GET", "table", "condition");
                break;
            case "insert_customer":
                return array("POST", "first", "last", "address", "email", "password");
                break;
            case "update_customer":
                return array("POST", "field", "new_value", "password");
                break;
            case "search_customer":
                return array("POST", "email", "password");
                break;
            default:
                http_response_code(501);
                die(failureToJSON($action . " isn't implementation yet!"));
        }
    }
}