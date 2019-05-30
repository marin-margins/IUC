<?php
require_once '../configuration.php';
$InstID = $_POST['post_person_id'];
$action = $_POST['action'];
switch ($_POST['action']) {
    case 'getData':
        print get_person_particapation($InstID);
        break;
}

function get_person_particapation($InstID){
    $page_setup = new class_page_setup();
    $db_instance = $page_setup->get_db_instance();
    $query ='select Concat(person.firstname ," ", person.lastname) as name,
 role.title as role ,
 eventtype.txt as type,
  eventt.start_date as date, 
  eventt.title as programme from person
join person_event_role on person.id = person_event_role.personId
join role on person_event_role.roleid= role.id
join eventt on person_event_role.eventId = eventt.id
join eventtype on eventt.typeId = eventtype.id
join institute on person.instituteId = institute.id
WHERE institute.id="'.$InstID.'"';
    $result = $db_instance->query($query);
    $inst_person_list_array = array();
        while ($row = $result->fetch_assoc()) {
            $inst_person_list_array[] = $row;
        }
        return json_encode($inst_person_list_array);

}

?>