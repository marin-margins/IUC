<?php

require_once './configuration.php';//ALWAYS REQUIRE CONFIGURATION . CLASS AUTOLOADER WONT WORK WITHOUT IT

$page_setup = new class_page_setup(); // CREATE THE CLASS PAGE SETUP

$db_instance = $page_setup->get_db_instance(); //GET DB INSTANCE SO YOU CAN USE DB FUNCTIONS

html_handler::build_header("Statistics"); //BUILD THE HEADER WITH PAGE TITLE PARAMETAR


?>

<style media="screen">
  td { cursor: pointer; }
  td:hover{
  background-color:#D2D7D3;
  opacity:1;
}
</style>

<h2>Statistics</h2> <br>
Select a report from list:
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

  <tr>
    <th>Title</th>
  </tr>

  <tr onclick="window.location ='statistics_total.php'">
   <td id="1">Statistics total</td>
  </tr>
  <tr onclick="window.location ='academicprogrammestatistics.php'">
   <td id="2">Academic programme statistics</td>
  </tr>
  <tr onclick="window.location ='courseAndConferenceCountPerInstitutions.php'">
   <td id="3">Course and conference count per institutions</td>
  </tr>
  <tr onclick="window.location ='participantsFromSpecificInstitution.php'">
   <td id="4">Participants from specific institution</td>
  </tr>
  <tr onclick="window.location ='participantsFromSpecificCountry.php'">
   <td id="5">Participants from specific country</td>
  </tr>


</table>

<?php
html_handler::build_footer();// BUILD THE FOOTER
?>
