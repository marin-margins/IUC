<?php


require_once './configuration.php';//ALWAYS REQUIRE CONFIGURATION . CLASS AUTOLOADER WONT WORK WITHOUT IT

$page_setup = new class_page_setup(); // CREATE THE CLASS PAGE SETUP

$db_instance = $page_setup->get_db_instance(); //GET DB INSTANCE SO YOU CAN USE DB FUNCTIONS

html_handler::build_header("Conferences"); //BUILD THE HEADER WITH PAGE TITLE PARAMETAR


// --------------- REST OF THE PHP CODE  ------------------
//dohvat za u tablicu, provjerit jeli ovo moze ovako
//refresh bezveze, ako treba pisat funkciju, napisa cu
//filter rucno ubacen
$query = 'SELECT eventt.eventnum,eventt.start_date,eventt.end_date,eventt.mystatus,SUM(gover_person.title),SUM(preson.academicStatus),eventt.title 
FROM eventt
JOIN person ON person.id = eventt.id
JOIN gover_person ON gover_person.personId = person.id
WHERE gover_person.title = organizer
AND person.academicStatus = lecturer ';
$result = $db_instance->query($query);
echo'<div class="card-body">
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
				';
				/*while ($row = $result->fetch_assoc()){
                  '<tr>
                    <td>' . $row["eventt.eventnum"] . '</td>
                    <td>' . $row["eventt.start_date"] . '</td>
                    <td>' . $row["eventt.end_date"] . '</td>
                    <td>' . $row["eventt.mystatus"] . '</td>
                    <td>' . $row["SUM(gover_person.title)"] . '</td>
                    <td>' . $row["SUM(preson.academicStatus)"] . '</td>
					<td>' . $row["eventt.title"] . '</td>
				</tr>
				';}*/			  
			echo'</table>
			</div>
			<button type="button" class="btn btn-primary">Edit details</button>
			<button type="button" class="btn btn-danger">Delete selected</button>
			<button type="button" class="btn btn-success">Create new</button>
			<button type="button" class="btn btn-info">View page</button>
		</div>';

?>

<!--- HTML code here--->

				  
				  

<!--- Html code ends--->

<?php
html_handler::build_footer();// BUILD THE FOOTER
?>












