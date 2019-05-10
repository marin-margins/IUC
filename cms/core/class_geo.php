<?php


class class_geo
{


    private $db_conn;
    public function __construct()
    {
        $db_class = new class_db_setup();
        $this->db_conn = $db_class->get_db();
    }


    public static function get_all_countries($db_conn){

        $query = 'SELECT name,id FROM country';
        $result = $db_conn->query($query);
        $contries = array();

        while ($row = $result->fetch_assoc()) {

            $contries[] = $row;

        }
        return $contries;

    }

    public static function get_towns_by_city_id($db_conn,$country_id){

        $query = 'SELECT id,name FROM city WHERE countryId="' . $country_id . '"';
        $result = $db_conn->query($query);
        $cities = array();

        while ($row = $result->fetch_assoc()) {

            $cities[] = $row;

        }
        return $cities;

    }




}