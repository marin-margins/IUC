<?php
/**
 * Created by PhpStorm.
 * User: Ez01
 * Date: 03/05/2019
 * Time: 09:11
 */

class class_debug
{

    static function get_time($add_time = "")
    {

        if ($add_time == "") {
            $date = date('Y-m-d H:i:s');
        } else {
            $date = date('Y-m-d H:i:s', strtotime($add_time));
        }

        return $date;
    }

    static function debug($data)
    {

        echo '<pre>' . var_dump($data) . '</pre>';

    }
}