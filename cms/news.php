<?php


require_once './configuration.php';//ALWAYS REQUIRE CONFIGURATION . CLASS AUTOLOADER WONT WORK WITHOUT IT

$page_setup = new class_page_setup(); // CREATE THE CLASS PAGE SETUP

$db_instance = $page_setup->get_db_instance(); //GET DB INSTANCE SO YOU CAN USE DB FUNCTIONS

// ---------------PHP CODE ------------------
$query = 'SELECT title,date,summary FROM news';
$result = $db_instance->query($query);
$tr_array = array();
while ($row = $result->fetch_assoc()) {
    //punjenje tablice s rezultatima
    $tr_array[] = '<tr class="clickable-row " role="row">
    <td>' . $row["date"] . '</td>
    <td>' . $row["title"].'</td>
    <td>' . $row["summary"] . '</td>
    </tr>';
}



html_handler::build_header("News List"); //BUILD THE HEADER WITH PAGE TITLE PARAMETAR

html_handler::import_lib("news.js");






?>

<!--- HTML code here--->
<div class="row">
    <div class="col-md-12 col-md-offset-0">
        <div class="card mb-3">
            <div class="card-header">
                <i class="fas fa-table"></i>
                News List
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="example" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th scope="col">Date</th>
                                <th scope="col">Title</th>
                                <th scope="col">Summary</th>
                            
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($tr_array as $table_row_item) {
    echo $table_row_item;
}?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
	</div>
	<div class="float-right">
				
                <button id="delete" class="btn btn-secondary">View Page</button>
				    <input type="submit" id="insert" name="insert_button" class="btn btn-success" value="Create New">
				      <input type="submit" id="update" name="update_button"  class="btn btn-warning"
                    value="Edit Details">
            
           
                <button id="delete" class="btn btn-danger">Delete</button>
              
           
      
    </div>
</div>

<!--- Html code ends--->
<?php

html_handler::build_footer(); // BUILD THE FOOTER

?>






<!--- Html code ends--->

<?php
html_handler::build_footer();// BUILD THE FOOTER
?>


