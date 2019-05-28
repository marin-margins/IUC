<?php

require_once './configuration.php';//ALWAYS REQUIRE CONFIGURATION . CLASS AUTOLOADER WONT WORK WITHOUT IT

$page_setup = new class_page_setup(); // CREATE THE CLASS PAGE SETUP

$db_instance = $page_setup->get_db_instance(); //GET DB INSTANCE SO YOU CAN USE DB FUNCTIONS

html_handler::build_header("Statistics"); //BUILD THE HEADER WITH PAGE TITLE PARAMETAR


?>

<h2>Statistics</h2> <br>
Select a report from list:
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

  <tr>
    <th>Title</th>
  </tr>

  <tr onclick="window.location ='statistics_total.php?id=1'">
   <td id="1">Statistics Total</td>
  </tr>
  <tr onclick="window.location ='statistics_total.php?id=2'">
   <td id="2">Academic Programme Statistics</td>
  </tr>


</table>

<?php
html_handler::build_footer();// BUILD THE FOOTER
?>
