<?php
require_once '../configuration.php';
$page_setup = new class_page_setup();
$db_instance = $page_setup->get_db_instance();
$personID = $_POST['post_person_id'];
$action = $_POST['action'];
switch ($action) {
    case 'getData':
        $query = 'SELECT title,firstname,lastname,academicStatus,institute.address AS instAddress,name,phone,fax,email,url,govern_person.memberFrom AS memberFrom,govern_person.memberTo AS memberTo,isActive,other FROM person JOIN govern_person ON id=personId JOIN institute ON instituteId=institute.id WHERE person.id=' . $personID;
        $result = $db_instance->query($query);
        //samo je jedan redak
        if ($row = $result->fetch_assoc()) {
            print json_encode($row);
        } else {
            print 0;
        }
        break;
    case 'delete':
        $query = 'UPDATE person SET aktivan=0 WHERE id="' . $personID . '"';
        $result = $db_instance->query($query);
        print $result;
        break;

    //ako odlucimo box na kraju ode ce bit
    //ako odlucimo box na kraju ode ce bit
    //ako odlucimo box na kraju ode ce bit
    //ako odlucimo box na kraju ode ce bit
    //ako odlucimo box na kraju ode ce bit
    //ako odlucimo box na kraju ode ce bit
    //ako odlucimo box na kraju ode ce bit
    //ako odlucimo box na kraju ode ce bit
    //ako odlucimo box na kraju ode ce bit
    //ako odlucimo box na kraju ode ce bit
    //ako odlucimo box na kraju ode ce bit
    //ako odlucimo box na kraju ode ce bit
    case 'getCities':
        $query = 'SELECT id,name FROM city WHERE countryId="' . $instID . '"';
        $result = $db_instance->query($query);
        $cities = '';
        while ($row = $result->fetch_assoc()) {
            $cities .= '<option value="' . $row["id"] . '">' . $row["name"] . '</option>';}
        print $cities;
        break;
}