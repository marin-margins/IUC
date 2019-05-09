<?php


require_once './configuration.php';//ALWAYS REQUIRE CONFIGURATION . CLASS AUTOLOADER WONT WORK WITHOUT IT

$page_setup = new class_page_setup(); // CREATE THE CLASS PAGE SETUP

$db_instance = $page_setup->get_db_instance(); //GET DB INSTANCE SO YOU CAN USE DB FUNCTIONS

html_handler::build_header("Courses"); //BUILD THE HEADER WITH PAGE TITLE PARAMETAR


// --------------- REST OF THE PHP CODE  ------------------


?>

<!--- HTML code here--->
 <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Number</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Status</th>
                    <th>Directors</th>
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
                    <th>Directors</th>
                    <th>Lecturers</th>
					<th>Title</th>
                  </tr>
                </tfoot>
                <tbody>
                  <tr>
                    <td>Tiger Nixon</td>
                    <td>System Architect</td>
                    <td>Edinburgh</td>
                    <td>61</td>
                    <td>2011/04/25</td>
                    <td>$320,800</td>
					<td>Title</td>
                  </tr>
				  <tr>
                    <td>Tiger Nixon</td>
                    <td>System Architect</td>
                    <td>Edinburgh</td>
                    <td>61</td>
                    <td>2011/04/25</td>
                    <td>$320,800</td>
					<td>Title</td>
                  </tr>
				  <tr>
                    <td>Tiger Nixon</td>
                    <td>System Architect</td>
                    <td>Edinburgh</td>
                    <td>61</td>
                    <td>2011/04/25</td>
                    <td>$320,800</td>
					<td>Title</td>
                  </tr>
				</table>
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












