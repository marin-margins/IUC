<?php

require_once './configuration.php';//ALWAYS REQUIRE CONFIGURATION . CLASS AUTOLOADER WONT WORK WITHOUT IT

$page_setup = new class_page_setup(); // CREATE THE CLASS PAGE SETUP

$db_instance = $page_setup->get_db_instance(); //GET DB INSTANCE SO YOU CAN USE DB FUNCTIONS

html_handler::build_header("Statistics"); //BUILD THE HEADER WITH PAGE TITLE PARAMETAR


//dodatno
$id = $_GET["id"];
if($id == "1"){
  $start_year = 2017; //testno
  $end_year =2019;
?>

<h2 style="display:inline;">REPORT: STATISTICS TOTAL</h2>
<button type="button" name="create" class="btn btn-primary" id="create_report" onclick="createReport()">Create report</button>
<button type="button" name="export" class="btn btn-danger"  onclick="Export2Doc('exportContent','word-content');">Export report</button>
<br> <br>

<div class="form-group">
  <label>Academic Cycle From:</label>
  <select class="selectpicker" id="year" name="">
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

<script>
function createReport() {
  //nesto...
}
</script>

<div id="exportContent">
  <table class="table table-bordered" style ="border: 1px solid black;" id="dataTable" width="100%" cellspacing="0">
    <tr style ="border: 1px solid black;">
      <th style ="border: 1px solid black;">Year</th>
      <th style ="border: 1px solid black;">Courses</th>
      <th style ="border: 1px solid black;">Conferences</th>
      <th style ="border: 1px solid black;">Participants</th>
    </tr>
    <?php
      $year = $start_year;
      $num_people;
      while($year <= $end_year){
        echo '<tr>';
        //Year
        $pom = $year+1;
        echo '<td style ="border: 1px solid black;">'.$year.'/'.$pom.'</td>';

        //FOR COURSES
        $query = 'SELECT id
                  FROM eventt
                  WHERE typeId = 1
                  AND DATE_FORMAT(start_date, "%Y") >= '.$year.' AND DATE_FORMAT(end_date, "%Y") <= '.$year.'';
        $result = $db_instance->query($query);
        if (!$result) {
          trigger_error('Invalid query: ' . $db_instance->error);
        }else{
        echo '<td style ="border: 1px solid black;">'. $result->num_rows .'</td>';}

        //FOR CONFERENCES
        $query = 'SELECT id
                  FROM eventt
                  WHERE typeId = 2
                  AND DATE_FORMAT(start_date, "%Y") >= '.$year.' AND DATE_FORMAT(end_date, "%Y") <= '.$year.'';
        $result = $db_instance->query($query);
        if (!$result) {
          trigger_error('Invalid query: ' . $db_instance->error);
        }else{
        echo '<td style ="border: 1px solid black;">'. $result->num_rows .'</td>';}

        //FOR PEOPLE - krivo
        $query = 'SELECT sum(numUnregParticipants) AS value_sum
                  FROM eventt
                  WHERE DATE_FORMAT(start_date, "%Y") >= '.$year.' AND DATE_FORMAT(end_date, "%Y") <= '.$year.'';
        $result = $db_instance->query($query);
        if (!$result) {
          trigger_error('Invalid query: ' . $db_instance->error);
        }else{
          while($row = $result->fetch_assoc()) {
            echo '<td style ="border: 1px solid black;">'. $row["value_sum"] .'</td>';
          }
        }

        echo '</tr>';
        $year = $year + 1;
      }
    ?>
  </table>
</div>

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
