<?php
require_once '../configuration.php';
$page_setup = new class_page_setup();
$db_instance = $page_setup->get_db_instance();
$instID = $_POST['post_inst_id'];
$action = $_POST['action'];
switch ($action) {
    case 'getData':
        $query = 'SELECT name,address,webAddress,isMember,president,iucRepresentative,financeContact,internationalContact,memberFrom,memberTo,comment FROM institute WHERE id=' . $instID;
        $result = $db_instance->query($query);
        //samo je jedan redak
        if ($row = $result->fetch_assoc()) {
            print json_encode($row);
        } else {
            print 0;
        }
        break;
    case 'delete':
        $query = 'UPDATE institute SET aktivan=0 WHERE id="' . $instID . '"';
        $result = $db_instance->query($query);
        print $result;
        break;
    case 'getCities':
        $query = 'SELECT id,name FROM city WHERE countryId="' . $instID . '"';
        $result = $db_instance->query($query);
        $cities = '';
        while ($row = $result->fetch_assoc()) {
            $cities .= '<option value="' . $row["id"] . '">' . $row["name"] . '</option>';}
        print $cities;
        break;
}