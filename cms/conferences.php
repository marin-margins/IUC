<?php


require_once './configuration.php';//ALWAYS REQUIRE CONFIGURATION . CLASS AUTOLOADER WONT WORK WITHOUT IT

$page_setup = new class_page_setup(); // CREATE THE CLASS PAGE SETUP

$db_instance = $page_setup->get_db_instance(); //GET DB INSTANCE SO YOU CAN USE DB FUNCTIONS

html_handler::build_header("Conferences"); //BUILD THE HEADER WITH PAGE TITLE PARAMETAR


// --------------- REST OF THE PHP CODE  ------------------
//dohvat za u tablicu, provjerit jeli ovo moze ovako
//refresh bezveze, ako treba pisat funkciju, napisa cu
//filter rucno ubacen
$query = 'SELECT eventt.eventnum as eventNum,eventt.start_date AS eventStart,eventt.end_date AS eventEnd,eventt.mystatus AS eventStatus,COUNT(CASE WHEN role.title = "organizer" THEN 1 ELSE NULL END) AS sumOrganizer,COUNT(CASE WHEN role.title = "lecturer" THEN 1 ELSE NULL END) AS sumLecturer,eventt.title AS eventTitle FROM eventt 
JOIN person_event_role ON eventt.id = person_event_role.eventId 
JOIN role ON role.id=person_event_role.roleId 
WHERE eventt.typeid = 2
GROUP BY eventt.id';
$result = $db_instance->query($query);
$conf_array = array();
while ($row = $result->fetch_assoc()) {
    $conf_array[] = $row;
}
?>

<!--- HTML code here--->
<div class="card-body">
            <div class="table-responsive">
			<h1>Conferences</h1>
			<br>
			<div class="form-group">
			<h4>Academic year:</h4>
			<select class="form-control" id="selectCountry" name="academicYear">
			  <option value="2019">2018/2019</option>
			  <option value="2018">2017/2018</option>
			  <option value="2017">2016/2017</option>
			</select>
			<br>
			<a href="conferences.php"><button type="button" class="btn btn-primary">Reload list</button></a>
			</div>
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Number</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Status</th>
                    <th>Organizers</th>
                    <th>Lecturers</th>
					<th>Title</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>Number</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Status</th>
                    <th>Organizers</th>
                    <th>Lecturers</th>
					<th>Title</th>
                  </tr>
                </tfoot>
                <tbody>
				<?php
            foreach ($conf_array as $row){
                echo '<tr>
                 <td>' . $row["eventNum"] . '</td>
                <td>' . $row["eventStart"] . '</td>
                <td>' . $row["eventEnd"] . '</td>
                <td>' . $row["eventStatus"] . '</td>
                <td>' . $row["sumOrganizer"] . '</td>
                <td>' . $row["sumLecturer"] . '</td>
                <td>' . $row["eventTitle"] . '</td>
                                     </tr>';}
            ?>
				</tbody>
				
				'</table>
			</div>
			<button type="button" class="btn btn-primary">Edit details</button>
			<button type="button" class="btn btn-danger">Delete selected</button>
			<button type="button" class="btn btn-success">Create new</button>
			<button type="button" class="btn btn-info">View page</button>
		</div>

				  
				  

<!--- Html code ends--->

<?php
html_handler::build_footer();// BUILD THE FOOTER
?>












