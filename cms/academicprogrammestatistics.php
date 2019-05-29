<?php

require_once './configuration.php';//ALWAYS REQUIRE CONFIGURATION . CLASS AUTOLOADER WONT WORK WITHOUT IT

$page_setup = new class_page_setup(); // CREATE THE CLASS PAGE SETUP

$db_instance = $page_setup->get_db_instance(); //GET DB INSTANCE SO YOU CAN USE DB FUNCTIONS

html_handler::build_header("Statistics"); //BUILD THE HEADER WITH PAGE TITLE PARAMETAR


?>


<h2 style="display:inline;">REPORT: Academic Programme Statistics</h2>
<button type="submit" name="create" class="btn btn-primary" form="table2">Create report</button>
<button type="button" name="export" class="btn btn-danger">Export report</button>
<br><br>
<form action="./statistics_total.php?id=2" method="post" name ="table2">
  Period From:
  <input type="date" id="date1" name="date1"/>
  To:
  <input type="date" id="date2" name="date2"/>
  <input type="submit" name="" value="Create report">
</form>
<?php

if(isset($_POST["date1"]) && empty($_POST["date1"]) || isset($_POST["date2"]) && empty($_POST["date2"])){
  echo "<script type='text/javascript'>alert('You need to select both dates');</script>";
}
?>
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
    <th>usa/canada</th>
    <th>other</th>
    <th>total</th>
  </tr>
  <tr>
    <?php
    if (isset($_POST["date1"]) && !empty($_POST["date1"]) && isset($_POST["date2"]) && !empty($_POST["date2"])) {
      $query = 'SELECT event.title, event.start_date, event.end_date,
                      COUNT(CASE WHEN country.name = "Croatia" THEN 1 ELSE NULL END) AS croatia,
                      COUNT(CASE WHEN country.name = "USA" THEN 1 ELSE NULL END) AS USA,
                      COUNT(CASE WHEN country.name != "Croatia" AND c.name != "USA" THEN 1 ELSE NULL END) AS other,
                      COUNT(*) AS total
                FROM eventt
                JOIN person_event_role ON person_event_role.evenId = eventt.id
                JOIN person ON person.id = person_event_role.personId
                JOIN eventType ON eventType.id = eventt.typeId
                JOIN country ON country.id = person.countryId
                JOIN continent ON continent.id = country.continentId
                WHERE event.typeId = 1
                AND DATE_FORMAT(start_date, "%Y") >= '.$year.' AND DATE_FORMAT(end_date, "%Y") <= '.$year.'';
      $result = $db_instance->query($query);
      if (!$result) {
        trigger_error('Invalid query: ' . $db_instance->error);
      }else{
      echo '<td style ="border: 1px solid gray;">'. $result->num_rows .'</td>';}
    }
    ?>
  </tr>
</table>



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
