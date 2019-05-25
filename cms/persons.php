<?php


require_once './configuration.php';//ALWAYS REQUIRE CONFIGURATION . CLASS AUTOLOADER WONT WORK WITHOUT IT

$page_setup = new class_page_setup(); // CREATE THE CLASS PAGE SETUP

$db_instance = $page_setup->get_db_instance(); //GET DB INSTANCE SO YOU CAN USE DB FUNCTIONS

html_handler::build_header("Persons"); //BUILD THE HEADER WITH PAGE TITLE PARAMETAR<?php

// --------------- REST OF THE PHP CODE  ------------------

//$all_institutions = class_institutions::get_all_institutions(true);

$all_countries = class_geo::get_all_countries($db_instance);

foreach ($all_countries as $row) {
    $countries_array[] = '<option value="' . $row["id"] . '">' . $row["name"] . '</option>';
}
$query = 'SELECT person.firstname,person.lastname,institute.name FROM person JOIN institute ON person.instituteId=institute.id';
$result = $db_instance->query($query);
while ($row = $result->fetch_assoc()) {
    $Persons[] = array(
        'FirstName' => $row['id'],
        'LastName' => $row['user'],
        'Country' => $row['Rješeni'],
        'Institution' => $row['nerješeni'],
    );

}

if(!empty($_POST['FrName']) && !empty($_POST['LaName']) && !empty($_POST["selectCountry"]) && !empty($_POST["selectInstituion"]) && isset($_POST["update_button"]) || isset($_POST["insert_button"])){

    $updateID = $_POST["update_id"];
    $FrName = $_POST['FrName'];
    $LaName = $_POST['LaName'];
    $Addres = $_POST['Addres'];
    $Phone = $_POST["Phone"];
    $Mobile = $_POST["Mobile"];
    $Fax = $_POST["Fax"];
    $Email = $_POST["Email"];
    $Webpage = $_POST["Webpage"];
    $InstitutionId = $_POST["selectInstitution"];
    $Department = $_POST["Department"];
    $AStatus = $_POST["AStatus"];
   // $DisplayInst = $_POST["DisplayInst"]; moram pitat sot je
    $_POST = array();
    if (!empty($updateID)) {
        //query za update tog Persona

        $result = $db_instance->query($query);
    } else {
        //crate new person
        $query = "INSERT INTO person (firstname,lastname,address,phone,mobile,fax,email,url,isntituteId,department,academicStatus,aktivan) 
        VALUES ($FrName,$LaName,$Addres,$Phone,$Mobile,$Fax,$Email,$Webpage,$InstitutionId,$Department,$AStatus,1)";
        $result = $db_instance->query($query);
    }
    header('Location: persons.php');
}

?>

<!--- HTML code here--->

<div class="row">
    <div class="col-md-9 col-md-offset-0">
        <div class="card mb-3">
            <div class="card-header">
                <i class="fas fa-table"></i>
                List of Peoples
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th scope="col">First name</th>
                            <th scope="col">Last name</th>
                            <th scope="col">Country</th>
                            <th scope="col">Instition</th>
                        </tr>
                        </thead>

                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-md-offset-1">
        <form method="POST" action="persons.php" id="forma">
            <div class="form-group">
                <div class="card-header">
                    <i class="fas fa-table"></i>
                    Persons details
                </div>
                <label>First name</label>
                <input type="hidden" value="" name="update_id">
                <input type="text" class="form-control" id="FirstName" name="FrName" value="">

                <label>Last name</label>
                <input type="text" class="form-control" id="LastName" name="LaName" value="">

                <label>Country</label>
                <select class="form-control" id="selectCountry" name="selectCountry" required>
                    <option value="" selected disabled hidden>Select Country</option>
                    <?php foreach ($countries_array as $country_row) {
                        echo $country_row;
                    }?>
                </select>

                <label>Address</label>
                <input type="text" class="form-control" id="Address" name="Addres" value="">

                <label>Phone</label>
                <input type="text" class="form-control" id="Phone" name="Phone" value="">

                <label>Mobile</label>
                <input type="text" class="form-control" id="Mobile" name="Mobile" value="">

                <label>Fax</label>
                <input type="text" class="form-control" id="Fax" name="Fax" value="">

                <label>Email</label>
                <input type="text" class="form-control" id="Email" name="Email" value="">

                <label>Web Page</label>
                <input type="text" class="form-control" id="WebPage" name="Webpage" value="">

                <label>Institution</label>
                    <select class="form-control" id="selectInstituion" name="selectInstitution" required>
                    <option value="" selected disabled hidden>Select Institution</option>
                    </select>

                <label>Department</label>
                <input type="text" class="form-control" id="Department" name="Department" value="">

                <label>Academic status</label>
                <input type="text" class="form-control" id="AcaStatus" name="AStatus" value="">

                <label>Display Institution</label>
                <input type="text" class="form-control" id="DisplayInstitution" name="DisplayInst" value="">

                <input type="submit" id="update" name="update_button" disabled class="btn btn-warning"
                       value="Apply Changes">
                <input type="submit" id="insert" name="insert_button" class="btn btn-success" value="Create New">

        </form>
    </div>
</div>


<!--- Html code ends--->

<?php
html_handler::build_footer();// BUILD THE FOOTER
?>


