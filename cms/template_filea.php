<?php


require_once './configuration.php';//ALWAYS REQUIRE CONFIGURATION . CLASS AUTOLOADER WONT WORK WITHOUT IT

$page_setup = new class_page_setup(); // CREATE THE CLASS PAGE SETUP

$db_instance = $page_setup->get_db_instance(); //GET DB INSTANCE SO YOU CAN USE DB FUNCTIONS

// ---------------PHP CODE ------------------









// --------------- BOTTOM OF PHP CODE  ------------------
html_handler::build_header("Page Title"); //BUILD THE HEADER WITH PAGE TITLE PARAMETARŽ

//THIS IS IMPORT LIB EXAMPLE PLEASE DELETE THIS !!!!!!!!!!!!!!!!!!!!!!!!//THIS IS IMPORT LIB EXAMPLE PLEASE DELETE THIS !!!!!!!!!!!!!!!!!!!!!!!!
html_handler::import_lib("example.js");//THIS IS IMPORT LIB EXAMPLE PLEASE DELETE THIS !!!!!!!!!!!!!!!!!!!!!!!!//THIS IS IMPORT LIB EXAMPLE PLEASE DELETE THIS !!!!!!!!!!!!!!!!!!!!!!!!
//THIS IS IMPORT LIB EXAMPLE PLEASE DELETE THIS !!!!!!!!!!!!!!!!!!!!!!!!//THIS IS IMPORT LIB EXAMPLE PLEASE DELETE THIS !!!!!!!!!!!!!!!!!!!!!!!!
html_handler::import_lib("example.css");//THIS IS IMPORT LIB EXAMPLE PLEASE DELETE THIS !!!!!!!!!!!!!!!!!!!!!!!!//THIS IS IMPORT LIB EXAMPLE PLEASE DELETE THIS !!!!!!!!!!!!!!!!!!!!!!!!
?>

<!--- HTML code here--->












<!--- Html code ends--->

<?php
html_handler::build_footer();// BUILD THE FOOTER
?>












