<?php

require_once './configuration.php';//ALWAYS REQUIRE CONFIGURATION . CLASS AUTOLOADER WONT WORK WITHOUT IT

$page_setup = new class_page_setup(); // CREATE THE CLASS PAGE SETUP

$db_instance = $page_setup->get_db_instance(); //GET DB INSTANCE SO YOU CAN USE DB FUNCTIONS

html_handler::build_header("Statistics"); //BUILD THE HEADER WITH PAGE TITLE PARAMETAR


  if(isset($_POST["date1"]) &&  empty($_POST["date1"]) || isset($_POST["date2"]) && empty($_POST["date2"]) ||  isset($_POST["radio"]) && empty($_POST["radio"])){
    echo "<script type='text/javascript'>alert('You need to select both dates');</script>";
  }
?>

<h2 style="display:inline;">REPORT: Course and conference count per institutions</h2>
<button type="button" name="export" class="btn btn-danger"  onclick="Export2Doc('exportContent','courseAndConferenceCountPerInstitutions');">Export report</button>
<br> <br>

<form action="./courseAndConferenceCountPerInstitutions.php" method="post" name ="table2">
  Period From:
  <input type="date" id="date1" name="date1"/>
  To:
  <input type="date" id="date2" name="date2"/>
  <br> <br>
  <p style="display:inline;margin-right:15px">Institution Type:</p>
  <input style="margin-left:15px" type="radio" name="radio" value="institutions" checked>All institutions
  <input style="margin-left:15px" type="radio" name="radio" value="members">Members
  <input style="margin-left:15px" type="radio" name="radio" value="nonMembers">Non Members
  <input style="margin-left:15px" type="submit" name="" value="Create report" class="btn btn-primary">
</form>

<div class="">

</div>
<div id="exportContent">
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
  <tr>
    <th style ="border: 1px solid gray;">Name</th>
    <th style ="border: 1px solid gray;">Courses</th>
    <th style ="border: 1px solid gray;">by organizers</th>
    <th style ="border: 1px solid gray;">with lecturers</th>
    <th style ="border: 1px solid gray;">with participants</th>
    <th style ="border: 1px solid gray;">Conferences</th>
    <th style ="border: 1px solid gray;">by organizers</th>
    <th style ="border: 1px solid gray;">with lecturers</th>
    <th style ="border: 1px solid gray;">with participants</th>
  </tr>
<?php
  if (isset($_POST["date1"]) && !empty($_POST["date1"]) && isset($_POST["date2"]) && !empty($_POST["date2"])  && isset($_POST["radio"]) && !empty($_POST["radio"])) {
    $date1 = $_POST["date1"];
    $date2 = $_POST["date2"];
    $radio = $_POST["radio"];
?>
      <tr>
       <?php
       if($radio == "institutions"){
         $query = 'SELECT eventt.title as name,
                         COUNT(CASE WHEN eventt.typeId = 1 THEN 1 ELSE NULL END) AS courses,
                         COUNT(CASE WHEN eventt.typeId = 1 AND role.title = "organizer" THEN 1 ELSE NULL END) AS organizer,
                         COUNT(CASE WHEN eventt.typeId = 1 AND role.title = "lecturer" THEN 1 ELSE NULL END) AS lecturer,
                         COUNT(CASE WHEN eventt.typeId = 1 AND role.title = "participant" THEN 1 ELSE NULL END) AS participant,
                         COUNT(CASE WHEN eventt.typeId = 2 THEN 1 ELSE NULL END) AS conferences,
                         COUNT(CASE WHEN eventt.typeId = 2 AND role.title = "organizer" THEN 1 ELSE NULL END) AS organizer2,
                         COUNT(CASE WHEN eventt.typeId = 2 AND role.title = "lecturer" THEN 1 ELSE NULL END) AS lecturer2,
                         COUNT(CASE WHEN eventt.typeId = 2 AND role.title = "participant" THEN 1 ELSE NULL END) AS participant2
                   FROM eventt
                   JOIN person_event_role ON person_event_role.eventId = eventt.id
                   JOIN role ON role.id = person_event_role.roleId
                   JOIN person ON person.id = person_event_role.personId
                   JOIN eventType ON eventType.id = eventt.typeId
                   WHERE start_date >= "'.$date1.'" AND end_date <= "'.$date2.'"';
       }
       elseif ($radio == "members") {
         $query = 'SELECT eventt.title as name,
                         COUNT(CASE WHEN eventt.typeId = 1 THEN 1 ELSE NULL END) AS courses,
                         COUNT(CASE WHEN eventt.typeId = 1 AND role.title = "organizer" THEN 1 ELSE NULL END) AS organizer,
                         COUNT(CASE WHEN eventt.typeId = 1 AND role.title = "lecturer" THEN 1 ELSE NULL END) AS lecturer,
                         COUNT(CASE WHEN eventt.typeId = 1 AND role.title = "participant" THEN 1 ELSE NULL END) AS participant,
                         COUNT(CASE WHEN eventt.typeId = 2 THEN 1 ELSE NULL END) AS conferences,
                         COUNT(CASE WHEN eventt.typeId = 2 AND role.title = "organizer" THEN 1 ELSE NULL END) AS organizer2,
                         COUNT(CASE WHEN eventt.typeId = 2 AND role.title = "lecturer" THEN 1 ELSE NULL END) AS lecturer2,
                         COUNT(CASE WHEN eventt.typeId = 2 AND role.title = "participant" THEN 1 ELSE NULL END) AS participant2
                   FROM eventt
                   JOIN person_event_role ON person_event_role.eventId = eventt.id
                   JOIN role ON role.id = person_event_role.roleId
                   JOIN person ON person.id = person_event_role.personId
                   JOIN eventType ON eventType.id = eventt.typeId
                   WHERE eventt.aktivan = 1
                   AND start_date >= "'.$date1.'" AND end_date <= "'.$date2.'"';
       }
       elseif ($radio == "nonMembers") {
         $query = 'SELECT eventt.title as name,
                         COUNT(CASE WHEN eventt.typeId = 1 THEN 1 ELSE NULL END) AS courses,
                         COUNT(CASE WHEN eventt.typeId = 1 AND role.title = "organizer" THEN 1 ELSE NULL END) AS organizer,
                         COUNT(CASE WHEN eventt.typeId = 1 AND role.title = "lecturer" THEN 1 ELSE NULL END) AS lecturer,
                         COUNT(CASE WHEN eventt.typeId = 1 AND role.title = "participant" THEN 1 ELSE NULL END) AS participant,
                         COUNT(CASE WHEN eventt.typeId = 2 THEN 1 ELSE NULL END) AS conferences,
                         COUNT(CASE WHEN eventt.typeId = 2 AND role.title = "organizer" THEN 1 ELSE NULL END) AS organizer2,
                         COUNT(CASE WHEN eventt.typeId = 2 AND role.title = "lecturer" THEN 1 ELSE NULL END) AS lecturer2,
                         COUNT(CASE WHEN eventt.typeId = 2 AND role.title = "participant" THEN 1 ELSE NULL END) AS participant2
                   FROM eventt
                   JOIN person_event_role ON person_event_role.eventId = eventt.id
                   JOIN role ON role.id = person_event_role.roleId
                   JOIN person ON person.id = person_event_role.personId
                   JOIN eventType ON eventType.id = eventt.typeId
                   WHERE eventt.aktivan = 0
                   AND start_date >= "'.$date1.'" AND end_date <= "'.$date2.'"';
       }
         $result = $db_instance->query($query);
         if (!$result) {
           trigger_error('Invalid query: ' . $db_instance->error);
         }else{
           while($row = $result->fetch_assoc()) {
             echo '<td style ="border: 1px solid gray;">'. $row["name"] .'</td>';
             echo '<td style ="border: 1px solid gray;">'. $row["courses"] .'</td>';
             echo '<td style ="border: 1px solid gray;">'. $row["organizer"] .'</td>';
             echo '<td style ="border: 1px solid gray;">'. $row["lecturer"] .'</td>';
             echo '<td style ="border: 1px solid gray;">'. $row["participant"] .'</td>';
             echo '<td style ="border: 1px solid gray;">'. $row["conferences"] .'</td>';
             echo '<td style ="border: 1px solid gray;">'. $row["organizer2"] .'</td>';
             echo '<td style ="border: 1px solid gray;">'. $row["lecturer2"] .'</td>';
             echo '<td style ="border: 1px solid gray;">'. $row["participant2"] .'</td>';
           }
         }
       ?>
      </tr>
    </table>
  </div>
<?php
    }
?>

<script type="text/javascript">
function Export2Doc(element, filename = ''){
    var preHtml = "<html xmlns:o='urn:schemas-microsoft-com:office:office' xmlns:w='urn:schemas-microsoft-com:office:word' xmlns='http://www.w3.org/TR/REC-html40'><head><meta charset='utf-8'><title>Export HTML To Doc</title></head><body>";
    var postHtml = "</body></html>";
    var html = preHtml+document.getElementById(element).innerHTML+postHtml;

    var blob = new Blob(['\ufeff', html], {
        type: 'application/msword'
    });

    // Specify link url
    var url = 'data:application/vnd.ms-word;charset=utf-8,' + encodeURIComponent(html);

    // Specify file name
    filename = filename?filename+'.doc':'document.doc';

    // Create download link element
    var downloadLink = document.createElement("a");

    document.body.appendChild(downloadLink);

    if(navigator.msSaveOrOpenBlob ){
        navigator.msSaveOrOpenBlob(blob, filename);
    }else{
        // Create a link to the file
        downloadLink.href = url;

        // Setting the file name
        downloadLink.download = filename;

        //triggering the function
        downloadLink.click();
    }

    document.body.removeChild(downloadLink);
}
</script>

<?php
html_handler::build_footer();// BUILD THE FOOTER
?>
