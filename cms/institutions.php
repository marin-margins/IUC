<?php

require_once './configuration.php'; //ALWAYS REQUIRE CONFIGURATION . CLASS AUTOLOADER WONT WORK WITHOUT IT

$page_setup = new class_page_setup(); // CREATE THE CLASS PAGE SETUP

$db_instance = $page_setup->get_db_instance(); //GET DB INSTANCE SO YOU CAN USE DB FUNCTIONS

$institutions_object = new class_institutions();

$all_institutions = $institutions_object->get_all_institutions();

//query za listu svih drzava i punjenje option value-a

$all_countries = class_geo::get_all_countries($db_instance);

foreach ($all_countries as $row) {
    $countries_array[] = '<option value="' . $row["id"] . '">' . $row["name"] . '</option>';
}

//u slucaju pritiska na Apply Changes ili Create new
//provjera koji fieldovi ne smiju biti prazni IME,DRZAVA,GRAD,STATUS
if (!empty($_POST["instName"]) && isset($_POST["update_button"]) || isset($_POST["insert_button"]) && !empty($_POST["selectCity"]) && !empty($_POST["selectCountry"]) && !empty($_POST["selectStatus"])) {

    $updateID = $_POST["update_id"];
    $instName = $_POST['instName'];
    $cityID = $_POST['selectCity'];
    $status = revertMemberStatus($_POST['selectStatus']);
    $address = $_POST["address"];
    $webAddress = $_POST["webAddress"];
    $president = $_POST["president"];
    $financeContact = $_POST["financialContact"];
    $iucRepresentative = $_POST["iucRepresentative"];
    $memberFrom = $_POST["memberFrom"];
    $memberTo = $_POST["memberTo"];
    $other = $_POST["other"];
    $internationalContact = $_POST["internationalContact"];
    $_POST = array();
    if (!empty($updateID)) {
        //query za update tog instituta
        $query = "UPDATE institute SET cityId=$cityID,name='$instName',address='$address',webAddress='$webAddress',isMember='$status',president='$president',iucRepresentative='$iucRepresentative',financeContact='$financeContact',internationalContact='$internationalContact',memberFrom='$memberFrom',memberTo='$memberTo',comment='$other' WHERE id='$updateID'";
        $result = $db_instance->query($query);
    } else {
        //u slucaju da se pritisnuo create new onda je updateID prazan pa ulazi ovdje i odvija se insert
        $query = "INSERT INTO institute (name,cityId,address,webAddress,isMember,president,iucRepresentative,financeContact,internationalContact,memberFrom,memberTo,comment) VALUES ('$instName','$cityID','$address','$webAddress','$status','$president','$iucRepresentative','$financeContact','$internationalContact','$memberFrom','$memberTo','$other')";
        $result = $db_instance->query($query);
    }
    header('Location: institutions.php');
}

html_handler::build_header("List of institutions"); //BUILD THE HEADER WITH PAGE TITLE PARAMETAR

html_handler::import_lib("institutions.js");

?>

<!--- HTML code here--->
<div class="row">
    <div class="col-md-9 col-md-offset-0">
        <div class="card mb-3">
            <div class="card-header">
                <i class="fas fa-table"></i>
                List of institutions
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
                                                style="width: 203px;">Name</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Position: activate to sort column ascending"
                                                style="width: 311px;">City</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Office: activate to sort column ascending"
                                                style="width: 149px;">Country</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Age: activate to sort column ascending"
                                                style="width: 73px;">Status</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Start date: activate to sort column ascending"
                                                style="width: 145px;">Web address</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Salary: activate to sort column ascending"
                                                style="width: 118px;">Withdrawal</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th rowspan="1" colspan="1">Name</th>
                                            <th rowspan="1" colspan="1">City</th>
                                            <th rowspan="1" colspan="1">Country</th>
                                            <th rowspan="1" colspan="1">Status</th>
                                            <th rowspan="1" colspan="1">Web Address</th>
                                            <th rowspan="1" colspan="1">Withdrawal</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php foreach ($all_institutions as $row) {
    $string = $row["memberTo"];
    if ($row["memberTo"] == "0000-00-00") {
        $string = null;
    }
    echo '<tr class="institutionRow" data-instID="' . $row['instId'] . '" data-cityid="' . $row['cityId'] . '" data-countryid="' . $row['countryId'] . '">
                                        <td>' . $row["instName"] . '</td>
                                        <td>' . $row["cityName"] . '</td>
                                        <td>' . $row["countryName"] . '</td>
                                        <td>' . $institutions_object->checkMemberStatus($row["isMember"]) . '</td>
                                        <td>' . $row["webAddress"] . '</td>
                                        <td>' . $string . '</td>
                                        </tr>';}?>
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
        <form method="POST" action="institutions.php" id="forma">
            <div class="form-group">
                <div class="card-header">
                    <i class="fas fa-table"></i>
                    Institution details
                </div>
                <label>Institution name</label>
                <input type="hidden" id="formInstitutionID" value="" name="update_id">
                <input type="text" class="form-control" id="institutionName" name="instName" value="">
                <label>Country</label>
                <select class="form-control" id="selectCountry" name="selectCountry" required>
                    <option value="" selected disabled hidden>Select Country</option>
                    <?php foreach ($countries_array as $country_row) {
    echo $country_row;
}?>
                </select>
                <label>City</label>
                <select class="form-control" id="selectCity" name="selectCity" required>
                    <option value="" selected disabled hidden>Select City</option>
                </select>
                <label>Address</label>
                <input type="text" class="form-control" id="address" name="address" value="">

                <label>Web Address</label>
                <input type="text" class="form-control" id="webAddress" name="webAddress" value="">

                <label>Status</label>
                <select class="form-control" id="selectStatus" name="selectStatus" required>
                    <option value="" selected disabled hidden>Select Status</option>
                    <option value="Member">Member</option>
                    <option value="Associate Member">Associate Member</option>
                </select>

                <label>Reactor/president</label>
                <input type="text" class="form-control" id="president" name="president" value="">

                <label>IUC Council representative</label>
                <input type="text" class="form-control" id="iucRepresentative" name="iucRepresentative" value="">

                <label>Financial contact</label>
                <input type="text" class="form-control" id="financialContact" name="financialContact" value="">

                <label>International office contact</label>
                <input type="text" class="form-control" id="internationalContact" name="internationalContact" value="">

                <div class="form-group">
                    Member from <input type="date" id="memberFrom" name="memberFrom">
                </div>
                <div class="form-group">
                    Withdrawal <input type="date" id="memberTo" name="memberTo">
                </div>
                <div class="form-group">
                    <label>Other</label>
                    <textarea class="form-control" id="other" name="other" rows="2"></textarea>
                </div>
                <button id="delete" disabled class="btn btn-danger">Delete</button>
                <input type="submit" id="update" name="update_button" disabled class="btn btn-warning"
                    value="Apply Changes">
                <input type="submit" id="insert" name="insert_button" class="btn btn-success" value="Create New">
                <input type="hidden" id="reset" class="btn btn-success" value="Reset">
        </form>
    </div>
</div>

<!--- Html code ends--->
<?php

html_handler::build_footer(); // BUILD THE FOOTER

?>