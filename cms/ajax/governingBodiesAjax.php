<?php
require_once '../configuration.php';
$page_setup = new class_page_setup();
$db_instance = $page_setup->get_db_instance();
$personID = $_POST['post_person_id'];
$action = $_POST['action'];
switch ($action) {
    case 'getData':
        $query = 'SELECT filename,title,firstname,lastname,academicStatus,instituteAddress,instituteName,phone,fax,email,url,memberFrom,memberTo,isActive,other FROM person JOIN govern_person ON person.id=personId JOIN img ON img.id=imgId WHERE img.aktivan=1 AND person.id=' . $personID;
        $result = $db_instance->query($query);
        $row = $result->fetch_assoc();
        if ($row == 0) {
            //u slucaju da nema povezane slike
            $query = 'SELECT title,firstname,lastname,academicStatus,instituteAddress,instituteName,phone,fax,email,url,memberFrom,memberTo,isActive,other FROM person JOIN govern_person ON person.id=personId WHERE person.id=' . $personID;
            $result = $db_instance->query($query);
            $row = $result->fetch_assoc();
        }
        //samo je jedan redak
        print json_encode($row);
        break;
    case 'delete':
        $query = 'UPDATE person SET aktivan=0 WHERE id="' . $personID . '"';
        $result = $db_instance->query($query);
        print $result;
        break;
    case 'deletePic':
        //pronalazak ID-a slike od osobe preko selecta
        $query = 'SELECT imgId FROM person WHERE id="' . $personID . '"';
        $result = $db_instance->query($query);
        $row = $result->fetch_assoc();
        //lazno brisanje slike
        $query = 'UPDATE img SET aktivan=0 WHERE id="' . $row["imgId"] . '"';
        $result = $db_instance->query($query);
        print $result;
        break;
}