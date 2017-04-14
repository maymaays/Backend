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
     * all available action.
     * @param $action
     * @return array|null
     */
    public static function get_required_parameter($action)
    {
        switch ($action) {
            case "select_all":
                return array("table", "condition");
                break;
            case "insert_customer":
                return array("id", "first", "last", "address", "email", "password");
                break;
            case "update_customer":
                return array("field", "new_value", "password");
                break;
            case "search_customer":
                return array("email", "password");
                break;
            default:
                http_response_code(501);
                die(failureToJSON($action . " isn't implementation yet!"));
        }
    }
}