<?php

require_once './configuration.php'; //ALWAYS REQUIRE CONFIGURATION . CLASS AUTOLOADER WONT WORK WITHOUT IT

$page_setup = new class_page_setup(); // CREATE THE CLASS PAGE SETUP

$db_instance = $page_setup->get_db_instance(); //GET DB INSTANCE SO YOU CAN USE DB FUNCTIONS

//Query za punjenje tablice
$query = 'SELECT person.id AS personId,title,firstname,lastname,academicStatus,institute.address AS instAddress,name  FROM person JOIN govern_person ON id=personId JOIN institute ON instituteId=institute.id WHERE person.aktivan=1';
$result = $db_instance->query($query);
$tr_array = array();
if (count($result) <= 0) {
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
    <td>' . $row["name"] . '</td>
    <td>' . $row["instAddress"] . '</td>
    </tr>';
    }
}
//nije do kraja dok ne skontamo kako cemo rjesit problem s institucijom, jedino kako moze je preko dropboxa da se mogu samo vec postojani oznacit, al treba njih pitat
//nije do kraja dok ne skontamo kako cemo rjesit problem s institucijom, jedino kako moze je preko dropboxa da se mogu samo vec postojani oznacit, al treba njih pitat
//nije do kraja dok ne skontamo kako cemo rjesit problem s institucijom, jedino kako moze je preko dropboxa da se mogu samo vec postojani oznacit, al treba njih pitat
//nije do kraja dok ne skontamo kako cemo rjesit problem s institucijom, jedino kako moze je preko dropboxa da se mogu samo vec postojani oznacit, al treba njih pitat
//nije do kraja dok ne skontamo kako cemo rjesit problem s institucijom, jedino kako moze je preko dropboxa da se mogu samo vec postojani oznacit, al treba njih pitat
//nije do kraja dok ne skontamo kako cemo rjesit problem s institucijom, jedino kako moze je preko dropboxa da se mogu samo vec postojani oznacit, al treba njih pitat
//nije do kraja dok ne skontamo kako cemo rjesit problem s institucijom, jedino kako moze je preko dropboxa da se mogu samo vec postojani oznacit, al treba njih pitat
//nije do kraja dok ne skontamo kako cemo rjesit problem s institucijom, jedino kako moze je preko dropboxa da se mogu samo vec postojani oznacit, al treba njih pitat

//u slucaju pritiska na Apply Changes ili Create new
if (isset($_POST["update_button"]) || isset($_POST["insert_button"])) {
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
    $instName2 = $_POST["instName2"];
    $address2 = $_POST["address2"];
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
        $query = "UPDATE govern_person SET title='$personTitle',isActive='$status',memberFrom='$memberFrom',memberTo='$memberTo',other='$other' WHERE id='$updateID'";
        $result = $db_instance->query($query);
        $query = "SELECT instituteId FROM person WHERE id='$updateID'";
        $result = $db_instance->query($query);
        $row = $result->fetch_assoc();
        $instID = $row["instituteId"];
        $query = "UPDATE institute SET name='$instName',address='$address' WHERE id='$instID'";
        $result = $db_instance->query($query);
    } else {
        //u slucaju da se pritisnuo create new onda je updateID prazan pa ulazi ovdje i odvija se insert
        $query = "INSERT INTO person (academicStatus,firstname,lastname,phone,fax,email,) VALUES ('$instName','$cityID','$address','$webAddress','$status','$president','$iucRepresentative','$financeContact','$internationalContact','$memberFrom','$memberTo','$other')";
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
                                <th scope="col">Title</th>
                                <th scope="col">Full Name</th>
                                <th scope="col">Institution</th>
                                <th scope="col">Address</th>
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
    <div class="col-md-3 col-md-offset-1">
        <form method="POST" action="governingBodies.php" id="forma">
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

                <label>Institution 2</label>
                <input type="text" class="form-control" id="instName2" name="instName2" value="">

                <label>Address 2</label>
                <input type="text" class="form-control" id="address2" name="address2" value="">

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
                <input type="hidden" id="uploadPic" class="btn btn-info" value="Upload picture">
                <input type="hidden" id="deletePic" class="btn btn-danger" value="Delete existing picture">
                <input type="hidden" id="reset" class="btn btn-success" value="Reset">
        </form>
    </div>
</div>

<!--- Html code ends--->
<?php

html_handler::build_footer(); // BUILD THE FOOTER

?>