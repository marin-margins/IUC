<?php

require_once './configuration.php'; //ALWAYS REQUIRE CONFIGURATION . CLASS AUTOLOADER WONT WORK WITHOUT IT

$page_setup = new class_page_setup(); // CREATE THE CLASS PAGE SETUP

$db_instance = $page_setup->get_db_instance(); //GET DB INSTANCE SO YOU CAN USE DB FUNCTIONS
//ostao insert slike, tin se treba dogovorit s bozom
//ostao insert slike, tin se treba dogovorit s bozom
//ostao insert slike, tin se treba dogovorit s bozom
//ostao insert slike, tin se treba dogovorit s bozom
//ostao insert slike, tin se treba dogovorit s bozom
//ostao insert slike, tin se treba dogovorit s bozom
//ostao insert slike, tin se treba dogovorit s bozom
//ostao insert slike, tin se treba dogovorit s bozom
//ostao insert slike, tin se treba dogovorit s bozom
//ostao insert slike, tin se treba dogovorit s bozom

//Query za punjenje tablice
$query = 'SELECT person.id AS personId,title,firstname,lastname,academicStatus,instituteAddress,instituteName FROM person JOIN govern_person ON id=personId WHERE aktivan=1';
$result = $db_instance->query($query);
$tr_array = array();
if ($result == false) {
    //ako nema rezultata tablica ce biti prazna
    $tr_array[] = '<tr class="personRow">
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    </tr>';
} else {
    while ($row = $result->fetch_assoc()) {
        //punjenje tablice s rezultatima
        $tr_array[] = '<tr class="personRow" data-personid="' . $row['personId'] . '">
    <td>' . $row["title"] . '</td>
    <td>' . $row["academicStatus"] . " " . $row["firstname"] . " " . $row["lastname"] . '</td>
    <td>' . $row["instituteName"] . '</td>
    <td>' . $row["instituteAddress"] . '</td>
    </tr>';
    }
}
//u slucaju pritiska na Apply Changes ili Create new
if (isset($_POST["update_button"]) || isset($_POST["insert_button"])) {
    //if (!empty($_FILES)) {
    //  $file_upload_return_message = class_file_upload::upload_file($_FILES["files"], "governingBodies");
    //}
    $updateID = $_POST["update_id"];
    $personTitle = $_POST['personTitle'];
    $academicStatus = $_POST['academicStatus'];
    $fullName = $_POST['fullName'];
    $lastSpaceIndex = strrpos($fullName, ' ');
    $firstName = substr($fullName, 0, $lastSpaceIndex);
    $lastName = substr($fullName, $lastSpaceIndex + 1, strlen($fullName));
    $instName = $_POST["instName"];
    $address = $_POST["address"];
    $status = $_POST["selectStatus"];
    $telephone = $_POST["telephone"];
    $fax = $_POST["fax"];
    $email = $_POST["email"];
    $webAddress = $_POST["webAddress"];
    $memberFrom = $_POST["memberFrom"];
    $selectStatus = $_POST["selectStatus"];
    $memberTo = $_POST["memberTo"];
    $other = $_POST["other"];
    $_POST = array();
    if (!empty($updateID)) {
        //query za update oznacenog covjeka i za institut
        $query = "UPDATE person SET academicStatus='$academicStatus',firstname='$firstName',lastname='$lastName',phone='$telephone',fax='$fax',email='$email',url='$webAddress' WHERE id='$updateID'";
        $result = $db_instance->query($query);
        $query = "UPDATE govern_person SET title='$personTitle',isActive='$status',memberFrom='$memberFrom',memberTo='$memberTo',other='$other',instituteAddress='$address',instituteName='$instName'  WHERE personId='$updateID'";
        $result = $db_instance->query($query);
    } else {
        //u slucaju da se pritisnuo create new onda je updateID prazan pa ulazi ovdje i odvija se insert
        $query = "INSERT INTO person (academicStatus,firstname,lastname,phone,fax,email,url) VALUES ('$academicStatus','$firstName','$lastName','$telephone','$fax','$email','$webAddress')";
        //treba dobit ID od zadnjeg inserta
        if ($db_instance->query($query) == true) {
            $personID = $db_instance->insert_id;
        }
        $query = "INSERT INTO govern_person(personId,title,memberFrom,memberTo,other,isActive,instituteName,instituteAddress) VALUES ('$personID','$personTitle','$memberFrom','$memberTo','$other','$selectStatus','$instName','$address');";
        $result = $db_instance->query($query);
    }
    header('Location: governingBodies.php');
}

html_handler::build_header("Governing bodies"); //BUILD THE HEADER WITH PAGE TITLE PARAMETAR

html_handler::import_lib("governingBodies.js");

?>

<!--- HTML code here--->
<div class="row">
    <div class="col-md-9 col-md-offset-0">
        <div class="card mb-3">
            <div class="card-header">
                <i class="fas fa-table"></i>
                Governing bodies list
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Full Name</th>
                                <th>Institution</th>
                                <th>Address</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Title</th>
                                <th>Full Name</th>
                                <th>Institution</th>
                                <th>Address</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php foreach ($tr_array as $table_row_item) {echo $table_row_item;}?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
        </div>
    </div>
    <div class="col-md-3 col-md-offset-1">
        <form method="post" enctype="multipart/form-data" action="governingBodies.php" id="forma">
            <div class="form-group">
                <div class="card-header">
                    <i class="fas fa-table"></i>
                    Details
                </div>
                <input type="hidden" id="formPersonID" value="" name="update_id">
                <label>Title</label>
                <input type="text" class="form-control" id="personTitle" name="personTitle" value="">

                <label>Academic Status</label>
                <input type="text" class="form-control" id="academicStatus" name="academicStatus" value="">

                <label>Full name</label>
                <input type="text" class="form-control" id="fullName" name="fullName" value="">

                <label>Institution</label>
                <input type="text" class="form-control" id="instName" name="instName" value="">

                <label>Address</label>
                <input type="text" class="form-control" id="address" name="address" value="">

                <label>Telephone</label>
                <input type="text" class="form-control" id="telephone" name="telephone" value="">

                <label>Fax</label>
                <input type="text" class="form-control" id="fax" name="fax" value="">

                <label>Email</label>
                <input type="text" class="form-control" id="email" name="email" value="">

                <label>Web page</label>
                <input type="text" class="form-control" id="webAddress" name="webAddress" value="">

                <div class="form-group">
                    Member from<input type="date" id="memberFrom" name="memberFrom">
                </div>

                <label>Status</label>
                <select class="form-control" id="selectStatus" name="selectStatus">
                    <option value="" selected disabled hidden>Select Status</option>
                    <option value="Y">Active</option>
                    <option value="N">Former</option>
                </select>

                <div class="form-group">
                    Resigned from<input type="date" id="memberTo" name="memberTo">
                </div>

                <div class="form-group">
                    <label>Other</label>
                    <textarea class="form-control" id="other" name="other" rows="3"></textarea>
                </div>
                <button id="delete" disabled class="btn btn-danger">Delete</button>
                <input type="submit" id="update" name="update_button" disabled class="btn btn-warning"
                    value="Apply Changes">
                <input type="submit" id="insert" name="insert_button" class="btn btn-success" value="Create New">
                <input type="hidden" id="deletePic" class="btn btn-danger" value="Delete existing picture">
                <input type="hidden" id="reset" class="btn btn-success" value="Reset">
                <!---File upload form--->
                <div class="col-md-3">
                    <br />
                    <input name="files" class="uploadForm" style="display:none" type="file" /><br />
                </div>
                <?php echo "<h2>" . $file_upload_return_message . "</h2>"; ?>
        </form>
    </div>
</div>

<!--- Html code ends--->
<?php

html_handler::build_footer(); // BUILD THE FOOTER

?>