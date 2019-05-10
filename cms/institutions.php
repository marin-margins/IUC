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
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">City</th>
                                <th scope="col">Country</th>
                                <th scope="col">Status</th>
                                <th scope="col"><?php $year = date('Y');
echo "$year fee"?></th>
                                <th scope="col">Web Adress</th>
                                <th scope="col">Withdrawal</th>
                            </tr>
                        </thead>

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
                                        <td>' . $row["suma"] . " " . $row["currencyName"] . '</td>
                                        <td>' . $row["webAddress"] . '</td>
                                        <td>' . $string . '</td>
                                        </tr>';
}
?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
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