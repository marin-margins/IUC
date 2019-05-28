<?php


require_once './configuration.php';//ALWAYS REQUIRE CONFIGURATION . CLASS AUTOLOADER WONT WORK WITHOUT IT

$page_setup = new class_page_setup(); // CREATE THE CLASS PAGE SETUP

$db_instance = $page_setup->get_db_instance(); //GET DB INSTANCE SO YOU CAN USE DB FUNCTIONS

// ---------------PHP CODE ------------------
$query = 'SELECT	id,title,date,summary FROM news';
$result = $db_instance->query($query);
$tr_array = array();
while ($row = $result->fetch_assoc()) {
    //punjenje tablice s rezultatima
    $tr_array[] = '<tr class="newsRow" data-newsid="' . $row['id'] . '">
    <td>' . $row["date"] . '</td>
    <td>' . $row["title"].'</td>
    <td>' . $row["summary"] . '</td>
    </tr>';
}



html_handler::build_header("News List"); //BUILD THE HEADER WITH PAGE TITLE PARAMETAR

html_handler::import_lib("news.js");






?>

<!--- HTML code here--->

<div class="row" id="TABLE">

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

        <div  id="bla" class="float-right">

            <button id="delete1" class="btn btn-secondary">View Page</button>
            <input type="submit" id="insert" name="insert_button" class="btn btn-success" value="Create New">
            <input type="submit" id="edit" name="update_button"  class="btn btn-warning"
                   value="Edit Details">


            <button id="delete" class="btn btn-danger">Delete</button>



        </div>

    </div>
</div>


 <div  id="FORM1"  class="col-md-12 col-md-offset-1">
        <form method="POST" action="news.php" id="forma">
            <div class="form-group">
                <div class="card-header">
                    <i class="fas fa-table"></i>
                    Details
                </div>
                <input type="hidden" id="formNewsID" value="" name="update_id">
                <label>Title</label>
                <input type="text" class="form-control" id="newsTitle" name="newsTitle" value="">
				<br>
                 <div class="form-group">
                   Date<input type="date" id="date" name="memberFrom">
                </div>
				
                <label>Summary</label>
                <input type="text" class="form-control" id="summary" name="fullName" value="">

                <label>Body</label>

                <input type="text" class="form-control" id="body" name="instName" value="">
                <br>
                <br>
                <button hidden id="delete1" class="btn btn-secondary">View Page</button>
                <input hidden type="submit" id="insert1" name="insert_button" class="btn btn-success" value="Create New">
                <input  type="submit" id="edit1" name="update_button"  class="btn btn-warning"
                       value="Edit Details">


                <button hidden id="delete" class="btn btn-danger">Delete</button>
                </div>
        </form>
 </div>







<!--- Html code ends--->

<?php
html_handler::build_footer();// BUILD THE FOOTER
?>


