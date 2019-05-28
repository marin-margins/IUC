<?php

require_once './configuration.php';//ALWAYS REQUIRE CONFIGURATION . CLASS AUTOLOADER WONT WORK WITHOUT IT

$page_setup = new class_page_setup(); // CREATE THE CLASS PAGE SETUP

$db_instance = $page_setup->get_db_instance(); //GET DB INSTANCE SO YOU CAN USE DB FUNCTIONS

html_handler::build_header("Statistics"); //BUILD THE HEADER WITH PAGE TITLE PARAMETAR


//dodatno
$id = $_GET["id"];
if($id == "1"){
  //varijable
  $year;
  $courses;
  $conferences;
  $participants;
?>

<h2 style="display:inline;">REPORT: STATISTICS TOTAL</h2>
<button type="button" name="create" class="btn btn-primary">Create report</button>
<button type="button" name="export" class="btn btn-danger">Export report</button>
<br> <br>

<div class="form-group">
  <label>Academic Cycle From:</label>
  <select class="selectpicker" id="" name="">
    <option value="2019">2018/2019</option>
    <option value="2018">2017/2018</option>
    <option value="2017">2016/2017</option>
  </select>
  <label>To:</label>
  <select class="selectpicker" id="" name="">
    <option value="2019">2018/2019</option>
    <option value="2018">2017/2018</option>
    <option value="2017">2016/2017</option>
  </select>
</div>

<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
  <tr>
    <th>Year</th>
    <th>Courses</th>
    <th>Conferences</th>
    <th>Participants</th>
  </tr>
  <tr>
   <td>a</td>
   <td>Statistics Total</td>
   <td>a</td>
   <td>Statistics Total</td>
  </tr>
</table>

<?php
}
else if($id == "2"){
?>

<h2 style="display:inline;">REPORT: Academic Programme Statistics</h2>
<button type="button" name="create" class="btn btn-primary">Create report</button>
<button type="button" name="export" class="btn btn-danger">Export report</button>
<br><br>

Period From:
<input type="date" id="date1"/>
To:
<input type="date" id="date2"/>
<br><br>
<h2>Show table:</h2>
<a class="h3" style="text-decoration:underline;margin-right:10px;color:gray" id="courses" onclick="">Courses</a>
<a class="h3" style="text-decoration:underline;color:gray" id="conferences" onclick="">Conferences</a>
<br> <br>

<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
  <tr>
    <th>Course</th>
    <th>from</th>
    <th>to</th>
    <th>Croatia</th>
    <th>EU</th>
    <th>non EU</th>
    <th>region</th>
    <th>usa/canada</th>
    <th>other</th>
    <th>total</th>
  </tr>
  <tr>
   <td>a</td>
   <td>b</td>
   <td>c</td>
   <td>d</td>
   <td>a</td>
   <td>b</td>
   <td>c</td>
   <td>d</td>
   <td>a</td>
   <td>b</td>
  </tr>
</table>

<?php
}
?>

<?php
html_handler::build_footer();// BUILD THE FOOTER
?>
