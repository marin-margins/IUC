<?php


require_once './configuration.php';//ALWAYS REQUIRE CONFIGURATION . CLASS AUTOLOADER WONT WORK WITHOUT IT

$page_setup = new class_page_setup(); // CREATE THE CLASS PAGE SETUP

$db_instance = $page_setup->get_db_instance(); //GET DB INSTANCE SO YOU CAN USE DB FUNCTIONS

html_handler::build_header("Persons"); //BUILD THE HEADER WITH PAGE TITLE PARAMETAR<?php

// --------------- REST OF THE PHP CODE  ------------------

//$all_institutions = class_institutions::get_all_institutions(true);
$query = 'SELECT institute.id,
                institute.name
                    FROM institute
                    WHERE institute.aktivan = 1
                    GROUP BY institute.id';
$result = $db_instance->query($query);
$inst_array = array();
while ($row = $result->fetch_assoc()) {
    $inst_array[] = $row;
}
foreach ($inst_array as $row){
    $instituitonarray[] ='<option value="' . $row["id"] . '">' . $row["name"] . '</option>';
}

$all_countries = class_geo::get_all_countries($db_instance);

foreach ($all_countries as $row) {
    $countries_array[] = '<option value="' . $row["id"] . '">' . $row["name"] . '</option>';
}
$query = 'SELECT person.id as persid,country.id as countryId ,institute.id as instId,person.firstname as FirstName,person.lastname as LastName,country.name as CountryName,institute.name as InstituteName 
FROM person 
JOIN institute ON person.instituteId=institute.id
JOIN country ON person.countryId=country.id';
$result = $db_instance->query($query);
$Persons[] = array();
while ($row = $result->fetch_assoc()) {
    $Persons[] = $row;
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
    $CountryId =$_POST["selectCountry"];
    $Department = $_POST["Department"];
    $AStatus = $_POST["AStatus"];
   // $DisplayInst = $_POST["DisplayInst"]; moram pitat sot je
    $_POST = array();
    if (!empty($updateID)) {
        //query za update tog Persona

        $result = $db_instance->query($query);
    } else {
        //crate new person
        $query = "INSERT INTO person (lastname,firstname,instituteId,address,phone,mobile,fax,email,url,academicStatus,department,countryid,aktivan) 
        VALUES ('$LaName','$FrName','$InstitutionId','$Addres','$Phone','$Mobile','$Fax','$Email','$Webpage','$AStatus','$Department','$CountryId',1)";
        //var_dump($query);
        $result = $db_instance->query($query);
    }
    header('Location: persons.php');
}

html_handler::import_lib("persons.js");
?>

<!--- HTML code here--->

<div class="row">
    <div class="col-md-9 col-md-offset-0">
        <div class="card mb-3">
            <div class="card-header">
                <i class="fas fa-table"></i>
                List of persons
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="dataTables_length" id="dataTable_length"><label>Show <select
                                                name="dataTable_length" aria-controls="dataTable"
                                                class="custom-select custom-select-sm form-control form-control-sm">
                                            <option value="10">10</option>
                                            <option value="25">25</option>
                                            <option value="50">50</option>
                                            <option value="100">100</option>
                                        </select> entries</label></div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div id="dataTable_filter" class="dataTables_filter"><label>Search:<input type="search"
                                                                                                          class="form-control form-control-sm" placeholder=""
                                                                                                          aria-controls="dataTable"></label></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-bordered dataTable" id="dataTable" width="100%"
                                       cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                                    <thead>
                                    <tr role="row">
                                        <th class="sorting_asc" tabindex="0" aria-controls="dataTable" rowspan="1"
                                            colspan="1" aria-sort="ascending"
                                            aria-label="Name: activate to sort column descending"
                                            style="width: 203px;">First Name</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                            colspan="1" aria-label="Position: activate to sort column ascending"
                                            style="width: 311px;">Last Name</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                            colspan="1" aria-label="Office: activate to sort column ascending"
                                            style="width: 149px;">Country</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                            colspan="1" aria-label="Age: activate to sort column ascending"
                                            style="width: 73px;">Instition</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th rowspan="1" colspan="1">First Name</th>
                                        <th rowspan="1" colspan="1">Last Name</th>
                                        <th rowspan="1" colspan="1">Country</th>
                                        <th rowspan="1" colspan="1">Instition</th>
                                    </tr>
                                    </tfoot>
                                    <tbody><?php foreach ($Persons as $row){
                                    echo '<tr class="personRow" data-persId="' . $row['persid'] . ' "data-instID="' . $row['instId'] . '" data-countryid="' . $row['countryId'] . '">
                                            <td>'.$row["FirstName"].'</td>
                                            <td>'.$row["LastName"].'</td>
                                            <td>'.$row["CountryName"].'</td>
                                            <td>'.$row["InstituteName"].'</td>
                                            </tr>';}

                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-5">
                                <div class="dataTables_info" id="dataTable_info" role="status" aria-live="polite">
                                    Showing 1 to 10 of 57 entries</div>
                            </div>
                            <div class="col-sm-12 col-md-7">
                                <div class="dataTables_paginate paging_simple_numbers" id="dataTable_paginate">
                                    <ul class="pagination">
                                        <li class="paginate_button page-item previous disabled" id="dataTable_previous">
                                            <a href="#" aria-controls="dataTable" data-dt-idx="0" tabindex="0"
                                               class="page-link">Previous</a></li>
                                        <li class="paginate_button page-item active"><a href="#"
                                                                                        aria-controls="dataTable" data-dt-idx="1" tabindex="0"
                                                                                        class="page-link">1</a></li>
                                        <li class="paginate_button page-item "><a href="#" aria-controls="dataTable"
                                                                                  data-dt-idx="2" tabindex="0" class="page-link">2</a></li>
                                        <li class="paginate_button page-item "><a href="#" aria-controls="dataTable"
                                                                                  data-dt-idx="3" tabindex="0" class="page-link">3</a></li>
                                        <li class="paginate_button page-item "><a href="#" aria-controls="dataTable"
                                                                                  data-dt-idx="4" tabindex="0" class="page-link">4</a></li>
                                        <li class="paginate_button page-item "><a href="#" aria-controls="dataTable"
                                                                                  data-dt-idx="5" tabindex="0" class="page-link">5</a></li>
                                        <li class="paginate_button page-item "><a href="#" aria-controls="dataTable"
                                                                                  data-dt-idx="6" tabindex="0" class="page-link">6</a></li>
                                        <li class="paginate_button page-item next" id="dataTable_next"><a href="#"
                                                                                                          aria-controls="dataTable" data-dt-idx="7" tabindex="0"
                                                                                                          class="page-link">Next</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
            </table>
        </div>
    </div>

    <div class="col-md-3 col-md-offset-1">
        <form method="POST" action="persons.php" id="forma">
            <div class="form-group">
                <div class="card-header">
                    <i class="fas fa-table"></i>
                    <i class="fas fa-table"></i>
                    Persons details
                </div>
                <label>First name</label>
                <input type="hidden" value="PersonID" name="update_id">
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
                        <?php foreach($instituitonarray as $inst_row ){
                            echo $inst_row;
                        }?>
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


