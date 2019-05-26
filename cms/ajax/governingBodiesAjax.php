<?php
require_once '../configuration.php';
$page_setup = new class_page_setup();
$db_instance = $page_setup->get_db_instance();
$personID = $_POST['post_person_id'];
$action = $_POST['action'];
switch ($action) {
    case 'getData':
        $query = 'SELECT title,firstname,lastname,academicStatus,instituteAddress,instituteName,phone,fax,email,url,memberFrom,memberTo,isActive,other FROM person JOIN govern_person ON id=personId WHERE id=' . $personID;
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
    case 'deletePic':
        //$query = 'UPDATE institute SET aktivan=0 WHERE id="' . $personID . '"';
        $result = $db_instance->query($query);
        print $result;
        break;
}