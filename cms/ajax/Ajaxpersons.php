<?php
require_once '../configuration.php';
$PersonID = $_POST['post_person_id'];
$action = $_POST['action'];
switch ($_POST['action']) {
    case 'getData':
        print get_person_details($PersonID);
        break;
}

function get_person_details($PersonID){
    $page_setup = new class_page_setup();
    $db_instance = $page_setup->get_db_instance();
    $query ='SELECT person.lastname,
                    person.firstname,
                    person.address,
                    person.phone,
                    person.mobile,
                    person.fax,
                    person.email,
                    person.url,
                    person.academicStatus,
                    person.department
                    FROM person
                    WHERE person.id="'.$PersonID.'"';
                    $result = $db_instance->query($query);
    while($row = $result->fetch_assoc()){
        $res_info[] = $row;
    }
    return json_encode($res_info);
}
?>