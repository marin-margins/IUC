<?php

class class_geo
{

    public static function get_all_countries($db_conn)
    {

        $query = 'SELECT name,id FROM country';
        $result = $db_conn->query($query);
        $contries = array();
        if ($result == false) {
            return $countries;
        } else {
            while ($row = $result->fetch_assoc()) {

                $contries[] = $row;
            }
            return $contries;}
    }

    public static function get_city_by_country_id($db_conn, $country_id)
    {

        $query = 'SELECT id,name FROM city WHERE countryId="' . $country_id . '"';
        $result = $db_conn->query($query);
        $cities = array();
        if ($result == false) {
            return $cities;
        } else {
            while ($row = $result->fetch_assoc()) {

                $cities[] = $row;
            }
            return $cities;}

    }

}