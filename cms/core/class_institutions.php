<?php

class class_institutions
{

    private $db_conn;
    public function __construct()
    {
        $db_class = new class_db_setup();
        $this->db_conn = $db_class->get_db();
    }

    //set active to false if u want all institutions not only active ones

    public function get_all_institutions($active = true)
    {

        $query = 'SELECT institute.id    AS instId,
                           institute.name  AS instName,
                           city.name       AS cityName,
                           city.id         AS cityId,
                           country.name    AS countryName,
                           country.id      AS countryId,
                           webAddress,
                           isMember,
                           memberTo
                    FROM institute
                             JOIN city ON institute.cityId = city.id
                             JOIN country ON city.countryId = country.id';
        if ($active == true) {
            $query .= '  WHERE institute.aktivan = 1';
        }
        $query .= '  GROUP BY institute.id';

        $result = $this->db_conn->query($query);
        $inst_array = array();

        while ($row = $result->fetch_assoc()) {

            $inst_array[] = $row;
        }
        return $inst_array;

    }

//provjerava status od membera i zamjenjuje to u tablici sa odgovarajućim stringom(Y=Member,N=Associate Member)

    public function revertMemberStatus($member)
    {
        if ($member == 'Member') {
            return "Y";
        } else {
            return "N";
        }

    }

    public function checkMemberStatus($member)
    {
        if ($member == 'Y') {
            return "Member";
        } else {
            return "Associate Member";
        }

    }

}