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

<h2 style="display:inline;">REPORT: Participants from specific country</h2>
<button type="button" name="export" class="btn btn-danger"  onclick="Export2Doc('exportContent',' Participantsfromspecificcountry');">Export report</button>
<br> <br>
<form action="./participantsFromSpecificCountry.php" method="post" name ="table2">
  Period From:
  <input type="date" id="date1" name="date1"/>
  To:
  <input type="date" id="date2" name="date2"/>
  <input type="submit" name="" value="Create report" class="btn btn-primary">
</form>

<div id="exportContent">
<?php
if (isset($_POST["date1"]) && !empty($_POST["date1"]) && isset($_POST["date2"]) && !empty($_POST["date2"])) {
    $date1 = $_POST["date1"];
    $date2 = $_POST["date2"];
?>
<div id="naslov" style="display:none;">
    <h3>REPORT: Participants from specific country</h3>
    <?php
    $pom1 = date("d-M-Y", strtotime($date1));;
    $pom2 = date("d-M-Y", strtotime($date2));;
    echo "<p>Date: ".$pom1."/ ".$pom2."</p>";
?>
</div>
  <div id="organizers_table" style="visibility:visible;margin-bottom:20px">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="border-collapse: collapse;">
      <tr>
        <th style ="border: 1px solid gray;">Country</th>
        <th style ="border: 1px solid gray;">Participants</th>
        <th style ="border: 1px solid gray;">Lecturers</th>
        <th style ="border: 1px solid gray;">Organizers</th>
        <th style ="border: 1px solid gray;">Total</th>
      </tr>
<?php
      $query = 'SELECT country.name as country,
                  COUNT(CASE WHEN role.title = "participant" THEN 1 ELSE NULL END) AS participants,
                  COUNT(CASE WHEN role.title = "lecturer" THEN 1 ELSE NULL END) AS lecturers,
                  COUNT(CASE WHEN role.title = "organizer" THEN 1 ELSE NULL END) AS organizers,
                  COUNT(*) AS total
                FROM eventt
                JOIN person_event_role ON person_event_role.eventId = eventt.id
                JOIN role ON role.id = person_event_role.roleId
                JOIN person ON person.id = person_event_role.personId
                JOIN country ON country.id = person.countryId
                WHERE start_date >= "'.$date1.'" AND end_date <= "'.$date2.'" GROUP BY country.name';
      $result = $db_instance->query($query);
      if (!$result) {
        trigger_error('Invalid query: ' . $db_instance->error);
      }else{
        while($row = $result->fetch_assoc()) {
          echo "<tr>";
          echo '<td style ="border: 1px solid gray;">'. $row["country"] .'</td>';
          echo '<td style ="border: 1px solid gray;">'. $row["participants"] .'</td>';
          echo '<td style ="border: 1px solid gray;">'. $row["lecturers"] .'</td>';
          echo '<td style ="border: 1px solid gray;">'. $row["organizers"] .'</td>';
          echo '<td style ="border: 1px solid gray;">'. $row["total"] .'</td>';
          echo "</tr>";
        }
      }
  }
?>
  </table>
  </div>
</div>

<script type="text/javascript">
function Export2Doc(element, filename = ''){
    var preHtml = "<html xmlns:o='urn:schemas-microsoft-com:office:office' xmlns:w='urn:schemas-microsoft-com:office:word' xmlns='http://www.w3.org/TR/REC-html40'><head><meta charset='utf-8'><title>Export HTML To Doc</title></head><body>";
    var naslov = document.getElementById('naslov').innerHTML;
    var postHtml = "</body></html>";
    var html = preHtml+naslov+document.getElementById(element).innerHTML+postHtml;

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
