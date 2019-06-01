<?php

require_once './configuration.php';//ALWAYS REQUIRE CONFIGURATION . CLASS AUTOLOADER WONT WORK WITHOUT IT

$page_setup = new class_page_setup(); // CREATE THE CLASS PAGE SETUP

$db_instance = $page_setup->get_db_instance(); //GET DB INSTANCE SO YOU CAN USE DB FUNCTIONS

html_handler::build_header("Statistics"); //BUILD THE HEADER WITH PAGE TITLE PARAMETAR

if(isset($_POST["date1"]) &&  empty($_POST["date1"]) || isset($_POST["date2"]) && empty($_POST["date2"]) ||  isset($_POST["radio"]) && empty($_POST["radio"])){
  echo "<script type='text/javascript'>alert('You need to select both dates');</script>";
}
?>
<style media="screen">
  li { cursor: pointer; }
</style>
<script>
  $(document).ready(function() {
      $(function() {
    		$("li#organizers").click(function() {
                if($("#lecturers_table").is(":visible")){
                    $("#lecturers_table").hide();
                    $('#organizers_table').show();
                }
                if($("#participants_table").is(":visible")){
                    $("#participants_table").hide();
                    $('#organizers_table').show();
                }
    		});
        $("li#lecturers").click(function() {
                if($("#organizers_table").is(":visible")){
                    $('#organizers_table').hide();
                    $("#lecturers_table").show();
                }
                if($("#participants_table").is(":visible")){
                    $("#participants_table").hide();
                    $("#lecturers_table").show();
                }
    		});
        $("li#participants").click(function() {
                if($("#lecturers_table").is(":visible")){
                    $("#lecturers_table").hide();
                    $('#participants_table').show();
                }
                if($("#organizers_table").is(":visible")){
                    $('#organizers_table').hide();
                    $("#participants_table").show();
                }
    		});
      });
  });
</script>

<h2 style="display:inline;">REPORT: Participants from specific institution</h2>
<button type="button" name="export" class="btn btn-danger"  onclick="Export2Doc('exportContent','statistics_total');">Export report</button>
<br> <br>
<form action="./participantsFromSpecificInstitution.php" method="post" name ="table2">
  Period From:
  <input type="date" id="date1" name="date1"/>
  To:
  <input type="date" id="date2" name="date2"/>
  <br> <br>
  Institution:
  <select class="selectpicker" id="start_year" name="institute">
    <?php
    $query = 'SELECT name as institute
              FROM institute';
    $result = $db_instance->query($query);
    if (!$result) {
      trigger_error('Invalid query: ' . $db_instance->error);
    }else{
      while($row = $result->fetch_assoc()) {
        echo '<option value="'.$row["institute"].'">'.$row["institute"].'</option>';
      }
    }
    ?>
  </select>
  <input type="submit" name="" value="Create report" class="btn btn-primary">
</form>

<div class="col-md-8">
  <ul class="list-inline">
    <li id="organizers" class="list-inline-item h4" >Organizers |</li>
    <li id="lecturers" class="list-inline-item h4">Lecturers |</li>
    <li id="participants" class="list-inline-item h4">Participants</li>
  </ul>
</div>

<div id="exportContent">
  <div id="organizers_table" style="visibility:visible;margin-bottom:20px">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
      <tr>
        <th style ="border: 1px solid gray;">Name</th>
        <th style ="border: 1px solid gray;">Email</th>
        <th style ="border: 1px solid gray;">Course</th>
        <th style ="border: 1px solid gray;">Course-date</th>
      </tr>
      <tr>
<?php
  if (isset($_POST["date1"]) && !empty($_POST["date1"]) && isset($_POST["date2"]) && !empty($_POST["date2"])) {
      $date1 = $_POST["date1"];
      $date2 = $_POST["date2"];
      $institute = $_POST["institute"];
      $query = 'SELECT person.firstname as name, person.lastname as lastname, person.email as email, eventt.title as course
                FROM eventt
                JOIN person_event_role ON person_event_role.eventId = eventt.id
                JOIN role ON role.id = person_event_role.roleId
                JOIN person ON person.id = person_event_role.personId
                JOIN institute ON institute.id = person.instituteId
                WHERE role.title = "organizer"
                AND institute.name = "'.$institute.'" AND start_date >= "'.$date1.'" AND end_date <= "'.$date2.'"';
      $result = $db_instance->query($query);
      if (!$result) {
        trigger_error('Invalid query: ' . $db_instance->error);
      }else{
        while($row = $result->fetch_assoc()) {
          $name = $row["name"]+$row["lastname"];
          echo '<td style ="border: 1px solid gray;">'.$name.'</td>';
          echo '<td style ="border: 1px solid gray;">'. $row["email"] .'</td>';
          echo '<td style ="border: 1px solid gray;">'. $row["course"] .'</td>';
          echo '<td style ="border: 1px solid gray;">'. $row["date"] .'</td>';
        }
      }
  }
?>
    </tr>
  </table>
  </div>
</div>

<div id="exportContent">
  <div id="lecturers_table" style="display:none;margin-bottom:20px">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
      <tr>
        <th style ="border: 1px solid gray;">Name</th>
        <th style ="border: 1px solid gray;">Email</th>
        <th style ="border: 1px solid gray;">Course</th>
        <th style ="border: 1px solid gray;">Course-date</th>
      </tr>
      <tr>
<?php
  if (isset($_POST["date1"]) && !empty($_POST["date1"]) && isset($_POST["date2"]) && !empty($_POST["date2"])) {
      $date1 = $_POST["date1"];
      $date2 = $_POST["date2"];
      $institute = $_POST["institute"];
      $query = 'SELECT person.firstname as name, person.lastname as lastname, person.email as email, eventt.title as course
                FROM eventt
                JOIN person_event_role ON person_event_role.eventId = eventt.id
                JOIN role ON role.id = person_event_role.roleId
                JOIN person ON person.id = person_event_role.personId
                JOIN institute ON institute.id = person.instituteId
                WHERE role.title = "lecturer"
                AND institute.name = "'.$institute.'" AND start_date >= "'.$date1.'" AND end_date <= "'.$date2.'"';
      $result = $db_instance->query($query);
      if (!$result) {
        trigger_error('Invalid query: ' . $db_instance->error);
      }else{
        while($row = $result->fetch_assoc()) {
          $name = $row["name"]+$row["lastname"];
          echo '<td style ="border: 1px solid gray;">'.$name.'</td>';
          echo '<td style ="border: 1px solid gray;">'. $row["email"] .'</td>';
          echo '<td style ="border: 1px solid gray;">'. $row["course"] .'</td>';
          echo '<td style ="border: 1px solid gray;">'. $row["date"] .'</td>';
        }
      }
  }
?>
    </tr>
  </table>
  </div>
</div>

<div id="exportContent">
  <div id="participants_table" style="display:none;margin-bottom:20px">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
      <tr>
        <th style ="border: 1px solid gray;">Name</th>
        <th style ="border: 1px solid gray;">Email</th>
        <th style ="border: 1px solid gray;">Course</th>
        <th style ="border: 1px solid gray;">Course-date</th>
      </tr>
      <tr>
<?php
  if (isset($_POST["date1"]) && !empty($_POST["date1"]) && isset($_POST["date2"]) && !empty($_POST["date2"])) {
      $date1 = $_POST["date1"];
      $date2 = $_POST["date2"];
      $institute = $_POST["institute"];
      $query = 'SELECT person.firstname as name, person.lastname as lastname, person.email as email, eventt.title as course, eventt.start_date as date
                FROM eventt
                JOIN person_event_role ON person_event_role.eventId = eventt.id
                JOIN role ON role.id = person_event_role.roleId
                JOIN person ON person.id = person_event_role.personId
                JOIN institute ON institute.id = person.instituteId
                WHERE role.title = "participant"
                AND institute.name = "'.$institute.'" AND start_date >= "'.$date1.'" AND end_date <= "'.$date2.'"';
      $result = $db_instance->query($query);
      if (!$result) {
        trigger_error('Invalid query: ' . $db_instance->error);
      }else{
        while($row = $result->fetch_assoc()) {
          $name = $row["name"].$row["lastname"];
          echo '<td style ="border: 1px solid gray;">'.$name.'</td>';
          echo '<td style ="border: 1px solid gray;">'. $row["email"] .'</td>';
          echo '<td style ="border: 1px solid gray;">'. $row["course"] .'</td>';
          echo '<td style ="border: 1px solid gray;">'. $row["date"] .'</td>';
        }
      }
  }
?>
    </tr>
  </table>
  </div>
</div>




<?php
html_handler::build_footer();// BUILD THE FOOTER
?>
