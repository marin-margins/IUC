<?php
require_once './configuration.php';//ALWAYS REQUIRE CONFIGURATION . CLASS AUTOLOADER WONT WORK WITHOUT IT

$page_setup = new class_page_setup(); // CREATE THE CLASS PAGE SETUP

$db_instance = $page_setup->get_db_instance(); //GET DB INSTANCE SO YOU CAN USE DB FUNCTIONS


// ---------------PHP CODE ------------------






// --------------- BOTTOM OF PHP CODE  ------------------
//build header and includes must be in the bottom of the first php script
html_handler::build_header("Dashboard"); //BUILD THE HEADER WITH PAGE TITLE PARAMETAR

html_handler::import_lib("example.js");

html_handler::import_lib("example.css");
?>

<!--- HTML code here--->

<h1> New framework update:</h1>
<h3>Added static method: <b> html_handler::import_lib("example.css");</b> for including libraries . all libraries must be in the js or css folder <b>WORKS WITH JS AND CSS</b>  </h3>

<br>
<h3>Added AJAX folder for all ajax files </h3>


<h1 style="color:red"> IMPORTANT!!!! </h1>
<h1 style="color:red"> see this files code for example </h1>
<br>
<h2 style="color:#00e8ff"> Build header static function must be  right before closing first ?> php script cause other headers wont work</h2>
<h2 style="color:#00e3ff">html_handler::import_lib(""); method must be after the build header function !!!!!!!!!!!!!</h2>
<!--- Html code ends--->

<?php
html_handler::build_footer();// BUILD THE FOOTER
?>


