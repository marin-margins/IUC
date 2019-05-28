<?php
require_once '../configuration.php';
$page_setup = new class_page_setup();
$db_instance = $page_setup->get_db_instance();
$newsID = $_POST['post_news_id'];

$action = $_POST['action'];
switch ($action) {
    case 'getData':
        $query = 'SELECT title,summary,body,date FROM news  WHERE id=' . $newsID;
        $result = $db_instance->query($query);
        //samo je jedan redak
        if ($row = $result->fetch_assoc()) {
            print json_encode($row);
        } else {
            print 0;
        }
        break;
    case 'editNews':
        $newstitle=$_POST['post_news_title'];
        $newsdate=$_POST['post_news_date'];
        $newssummary=$_POST['post_news_summary'];
        $newsbody=$_POST['post_news_body'];
        $query = 'UPDATE news SET title="'. $newstitle . '",date="'. $newsdate. '",summary="'.$newssummary.'",body="'.$newsbody.'" WHERE id=' . $personID ;
        $result = $db_instance->query($query);
        print $result;
        break;
    case 'delete':
        $query = 'DELETE FROM news  WHERE id=' . $newsID ;
        $result = $db_instance->query($query);
        print $result;
        break;
    case 'deletePic':
        //$query = 'UPDATE institute SET aktivan=0 WHERE id="' . $personID . '"';
        $result = $db_instance->query($query);
        print $result;
        break;
}