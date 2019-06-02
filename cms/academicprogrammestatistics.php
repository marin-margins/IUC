<?php

require_once './configuration.php';//ALWAYS REQUIRE CONFIGURATION . CLASS AUTOLOADER WONT WORK WITHOUT IT

$page_setup = new class_page_setup(); // CREATE THE CLASS PAGE SETUP

$db_instance = $page_setup->get_db_instance(); //GET DB INSTANCE SO YOU CAN USE DB FUNCTIONS

html_handler::build_header("Statistics"); //BUILD THE HEADER WITH PAGE TITLE PARAMETAR

?>

<script>
  $(document).ready(function() {
      $(function() {
    		$("li#courses").click(function() {
                if($("#conferences_table").is(":visible")){
                    $("#conferences_table").hide();
                    $('#course_table').show();
                }
    		});
    		$("li#conferences").click(function() {
    			if($("#course_table").is(":visible")){
    				$("#course_table").hide();
    				$('#conferences_table').show();
    			}
    		});
      });
  });
</script>


<h2 style="display:inline;">REPORT: Academic Programme Statistics</h2>
<button type="button" name="export" class="btn btn-danger"  onclick="Export2Doc('exportContent','academicprogrammestatistics');">Export report</button>
<br><br>
<form action="./academicprogrammestatistics.php" method="post" name ="table2">
  Period From:
  <input type="date" id="date1" name="date1"/>
  To:
  <input type="date" id="date2" name="date2"/>
  <input type="submit" name="" value="Create report" class="btn btn-primary">
</form>
<br>
<div class="col-md-8">
  <ul class="list-inline">
    <li id="courses" class="list-inline-item h4" >Courses |</li>
    <li id="conferences" class="list-inline-item h4">Conferences</li>
  </ul>
</div>
<?php

if(isset($_POST["date1"]) && empty($_POST["date1"]) || isset($_POST["date2"]) && empty($_POST["date2"])){
  echo "<script type='text/javascript'>alert('You need to select both dates');</script>";
}
?>

<div id="exportContent">
  <div id="course_table" style="visibility:visible;margin-bottom:20px">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
      <tr>
        <th style ="border: 1px solid gray;">Course</th>
        <th style ="border: 1px solid gray;">from</th>
        <th style ="border: 1px solid gray;">to</th>
        <th style ="border: 1px solid gray;">Croatia</th>
        <th style ="border: 1px solid gray;">usa/canada</th>
        <th style ="border: 1px solid gray;">other</th>
        <th style ="border: 1px solid gray;">total</th>
      </tr>
        <?php
        if (isset($_POST["date1"]) && !empty($_POST["date1"]) && isset($_POST["date2"]) && !empty($_POST["date2"])) {
            $date1 = $_POST["date1"];
            $date2 = $_POST["date2"];
            $query = 'SELECT eventt.title as title, eventt.start_date as start_date, eventt.end_date as end_date,
                            COUNT(CASE WHEN country.name = "Croatia" THEN 1 ELSE NULL END) AS croatia,
                            COUNT(CASE WHEN country.name = "USA" THEN 1 ELSE NULL END) AS USA,
                            COUNT(CASE WHEN country.name != "Croatia" AND country.name != "USA" THEN 1 ELSE NULL END) AS other,
                            COUNT(*) AS total
                      FROM eventt
                      JOIN person_event_role ON person_event_role.eventId = eventt.id
                      JOIN person ON person.id = person_event_role.personId
                      JOIN eventType ON eventType.id = eventt.typeId
                      JOIN country ON country.id = person.countryId
                      JOIN continent ON continent.id = country.continentId
                      WHERE eventt.typeId = 1
                      AND eventt.start_date >= "'.$date1.'" AND eventt.end_date <= "'.$date2.'" Group by title';
            $result = $db_instance->query($query);
            if (!$result) {
              trigger_error('Invalid query: ' . $db_instance->error);
            }else{
              while($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td style ="border: 1px solid gray;">'. $row["title"] .'</td>';
                echo '<td style ="border: 1px solid gray;">'. $row["start_date"] .'</td>';
                echo '<td style ="border: 1px solid gray;">'. $row["end_date"] .'</td>';
                echo '<td style ="border: 1px solid gray;">'. $row["croatia"] .'</td>';
                echo '<td style ="border: 1px solid gray;">'. $row["USA"] .'</td>';
                echo '<td style ="border: 1px solid gray;">'. $row["other"] .'</td>';
                echo '<td style ="border: 1px solid gray;">'. $row["total"] .'</td>';
                echo '</tr>';
              }
            }
        }
        ?>
    </table>
  </div>
  <div id="conferences_table" style="display: none;">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
      <tr>
        <th style ="border: 1px solid gray;">Conference</th>
        <th style ="border: 1px solid gray;">from</th>
        <th style ="border: 1px solid gray;">to</th>
        <th style ="border: 1px solid gray;">Croatia</th>
        <th style ="border: 1px solid gray;">usa/canada</th>
        <th style ="border: 1px solid gray;">other</th>
        <th style ="border: 1px solid gray;">total</th>
      </tr>
        <?php
        if (isset($_POST["date1"]) && !empty($_POST["date1"]) && isset($_POST["date2"]) && !empty($_POST["date2"])) {
            $query = 'SELECT eventt.title as title, eventt.start_date as start_date, eventt.end_date as end_date,
                            COUNT(CASE WHEN country.name = "Croatia" THEN 1 ELSE NULL END) AS croatia,
                            COUNT(CASE WHEN country.name = "USA" THEN 1 ELSE NULL END) AS USA,
                            COUNT(CASE WHEN country.name != "Croatia" AND country.name != "USA" THEN 1 ELSE NULL END) AS other,
                            COUNT(*) AS total
                      FROM eventt
                      JOIN person_event_role ON person_event_role.eventId = eventt.id
                      JOIN person ON person.id = person_event_role.personId
                      JOIN eventType ON eventType.id = eventt.typeId
                      JOIN country ON country.id = person.countryId
                      JOIN continent ON continent.id = country.continentId
                      WHERE eventt.typeId = 2
                      AND start_date >= "'.$date1.'" AND end_date <= "'.$date2.'"';
            $result = $db_instance->query($query);
            if (!$result) {
              trigger_error('Invalid query: ' . $db_instance->error);
            }else{
              while($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td style ="border: 1px solid gray;">'. $row["title"] .'</td>';
                echo '<td style ="border: 1px solid gray;">'. $row["start_date"] .'</td>';
                echo '<td style ="border: 1px solid gray;">'. $row["end_date"] .'</td>';
                echo '<td style ="border: 1px solid gray;">'. $row["croatia"] .'</td>';
                echo '<td style ="border: 1px solid gray;">'. $row["USA"] .'</td>';
                echo '<td style ="border: 1px solid gray;">'. $row["other"] .'</td>';
                echo '<td style ="border: 1px solid gray;">'. $row["total"] .'</td>';
                echo '</tr>';
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
