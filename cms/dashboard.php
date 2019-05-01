<?php

include "core/class_page_setup.php"; // PLEASE DEFINE THE CORRECT PATH OF THE CLASS

$page_setup = new class_page_setup(); // CREATE THE CLASS PAGE SETUP

$db_instance = $page_setup->get_db_instance(); //GET DB INSTANCE SO YOU CAN USE DB FUNCTIONS

$page_setup->build_header("Dashboard"); //BUILD THE HEADER WITH PAGE TITLE PARAMETAR




// --------------- REST OF THE PHP CODE  ------------------






?>

<!--- HTML code here--->





<!--- Html code ends--->

<?php
$page_setup->build_footer();// BUILD THE FOOTER
?>


