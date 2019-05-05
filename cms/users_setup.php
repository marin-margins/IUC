<?php


require_once './configuration.php';//ALWAYS REQUIRE CONFIGURATION . CLASS AUTOLOADER WONT WORK WITHOUT IT

$page_setup = new class_page_setup(); // CREATE THE CLASS PAGE SETUP

$db_instance = $page_setup->get_db_instance(); //GET DB INSTANCE SO YOU CAN USE DB FUNCTIONS

html_handler::build_header("Page Title"); //BUILD THE HEADER WITH PAGE TITLE PARAMETAR


// --------------- REST OF THE PHP CODE  ------------------


$query = 'SELECT * FROM user ';
$result = $db_instance->query($query);

$tr_array=array();

while($row = $result->fetch_assoc()){

    $tr_array[] = '<tr>
                    <td>'.$row["id"].'</td>
                    <td>'.$row["name"].'</td>
                    <td>'.$row["surname"].'</td>
                    <td>'.$row["e-mail"].'</td>
                    <td>'.$row["phone"].'</td>
                    <td>'.$row["active"].'</td>
                </tr>';

}


?>

<!--- HTML code here--->


<div class="card mb-3">
    <div class="card-header">
        <i class="fas fa-table"></i>
        Data Table Example</div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Surname</th>
                    <th>E-mail</th>
                    <th>Phone</th>
                    <th>Active</th>
                </tr>
                </thead>

                <tbody>
                <?php foreach ($tr_array as $table_row_item){
                    echo $table_row_item;
                } ?>

                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
</div>


<!--- Html code ends--->

<?php
html_handler::build_footer();// BUILD THE FOOTER
?>












