<?php

require_once './configuration.php';//ALWAYS REQUIRE CONFIGURATION . CLASS AUTOLOADER WONT WORK WITHOUT IT

$page_setup = new class_page_setup(); // CREATE THE CLASS PAGE SETUP

$db_instance = $page_setup->get_db_instance(); //GET DB INSTANCE SO YOU CAN USE DB FUNCTIONS

html_handler::build_header("Statistics"); //BUILD THE HEADER WITH PAGE TITLE PARAMETAR

?>

<h2 style="display:inline;">REPORT: STATISTICS TOTAL</h2>
<button type="button" name="export" class="btn btn-danger"  onclick="Export2Doc('exportContent','statistics_total');">Export report</button>
<br> <br>

<div class="form-group">
  <form action="statistics_total.php" method="post">
    <label>Academic Cycle From:</label>
    <select class="selectpicker" id="start_year" name="date1">
      <option value="2018">2018/2019</option>
      <option value="2017" selected>2017/2018</option>
      <option value="2016">2016/2017</option>
    </select>
    <label>To:</label>
    <select class="selectpicker" id="end_year" name="date2">
      <option value="2018" selected>2018/2019</option>
      <option value="2017">2017/2018</option>
      <option value="2016">2016/2017</option>
    </select>
    <input type="submit" name="createReport" value="Create report" class="btn btn-primary">
  </form>
</div>

<div id="exportContent">
  <table class="table table-bordered" style ="border: 1px solid gray;" id="dataTable" width="100%" cellspacing="0">
    <tr style ="border: 1px solid gray;">
      <th style ="border: 1px solid gray;">Year</th>
      <th style ="border: 1px solid gray;">Courses</th>
      <th style ="border: 1px solid gray;">Conferences</th>
      <th style ="border: 1px solid gray;">Participants</th>
    </tr>
    <?php
    if(isset($_POST["date1"]) && !empty($_POST["date1"]) && isset($_POST["date2"]) && !empty($_POST["date2"])){
      $start_year = $_POST["date1"];
      $end_year =  $_POST["date2"];
      $year = $start_year;
      $num_people;
      while($year <= $end_year){
        echo '<tr>';
        //Year
        $pom = $year+1;
        echo '<td style ="border: 1px solid gray;">'.$year.'/'.$pom.'</td>';

        //FOR COURSES
        $query = 'SELECT id
                  FROM eventt
                  WHERE typeId = 1
                  AND DATE_FORMAT(start_date, "%Y") >= "'.$year.'" AND DATE_FORMAT(end_date, "%Y") <= "'.$year.'"';
        $result = $db_instance->query($query);
        if (!$result) {
          trigger_error('Invalid query: ' . $db_instance->error);
        }else{
        echo '<td style ="border: 1px solid gray;">'. $result->num_rows .'</td>';}

        //FOR CONFERENCES
        $query = 'SELECT id
                  FROM eventt
                  WHERE typeId = 2
                  AND DATE_FORMAT(start_date, "%Y") >= "'.$year.'" AND DATE_FORMAT(end_date, "%Y") <= "'.$year.'"';
        $result = $db_instance->query($query);
        if (!$result) {
          trigger_error('Invalid query: ' . $db_instance->error);
        }else{
        echo '<td style ="border: 1px solid gray;">'. $result->num_rows .'</td>';}

        //FOR PEOPLE - krivo
        $query = 'SELECT sum(numUnregParticipants) AS value_sum
                  FROM eventt
                  WHERE DATE_FORMAT(start_date, "%Y") >= "'.$year.'" AND DATE_FORMAT(end_date, "%Y") <= "'.$year.'"';
        $result = $db_instance->query($query);
        if (!$result) {
          trigger_error('Invalid query: ' . $db_instance->error);
        }else{
          while($row = $result->fetch_assoc()) {
            echo '<td style ="border: 1px solid gray;">'. $row["value_sum"] .'</td>';
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
?>


<script type="text/javascript">
function Export2Doc(element, filename = ''){
    var preHtml = "<html xmlns:o='urn:schemas-microsoft-com:office:office' xmlns:w='urn:schemas-microsoft-com:office:word' xmlns='http://www.w3.org/TR/REC-html40'><head><meta charset='utf-8'><title>Export HTML To Doc</title></head><body>";
    var postHtml = "</body></html>";
    var logo = "<img src='./files/test_file_upload_dir/iuc_file_5ce95b17e2082.jpg'></img>"
    var html = preHtml+logo+document.getElementById(element).innerHTML+postHtml;

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
