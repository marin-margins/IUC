<?php

require_once './configuration.php'; //ALWAYS REQUIRE CONFIGURATION . CLASS AUTOLOADER WONT WORK WITHOUT IT

$page_setup = new class_page_setup(); // CREATE THE CLASS PAGE SETUP

$db_instance = $page_setup->get_db_instance(); //GET DB INSTANCE SO YOU CAN USE DB FUNCTIONS

html_handler::build_header("List of institutions"); //BUILD THE HEADER WITH PAGE TITLE PARAMETAR

//Query za tablicu i kasnije punjenje forme sa strane
$query = 'SELECT institute.name AS instName,city.name AS cityName,country.name AS countryName,SUM(paidAmount) AS suma,currency.name,webAddress,isMember,memberTo FROM institute JOIN city ON institute.cityId=city.id JOIN member_payment ON institute.id=instituteId JOIN currency ON member_payment.currencyId=currency.id JOIN country ON city.countryId=country.id GROUP BY institute.id';
$result = $db_instance->query($query);

$tr_array = array();
//provjerava status od membera i zamjenjuje to u tablici sa odgovarajućim stringom(Y=Member,N=Not a Member)
function checkMemberStatus(string $member): string
{
    if ($member == 'Y') {
        $return = "Member";
    } else {
        $return = "Not a member";
    }
    return $return;
}
//funkcija za brisanje iz institute s predanim imenom
function delete(string $name)
{
    if (confirm("Are you sure you want to delete " . $name . "?")) {
        //window.location.href="delete.php?del_id";
        $query = 'DELETE FROM institute WHERE name=' . $name;
        $result = $db_instance->exec($query);}
}
while ($row = $result->fetch_assoc()) {
//punjenje tablice s rezultatima
    //<td>' . '<a href="institutions.php?instName="' . $row["instName"] . '">' . $row["instName"] . '</a' . '</td>
    $tr_array[] = '<tr>
    <td>' . $row["instName"] . '</td>
    <td>' . $row["cityName"] . '</td>
    <td>' . $row["countryName"] . '</td>
    <td>' . checkMemberStatus($row["isMember"]) . '</td>
    <td>' . $row["suma"] . '</td>
    <td>' . $row["webAddress"] . '</td>
    <td>' . $row["memberTo"] . '</td>
    </tr>';

}
//query za listu svih drzava i punjenje option value-a
if (isset($_POST['countryName'])) {
    $country = $_POST['countryName'];
} else {
    $country = "";
}
$string = "";
$query = 'SELECT name FROM country';
$result = $db_instance->query($query);
$countries_array = array();
while ($row = $result->fetch_assoc()) {
    if (strcmp($row["name"], $country) == 0) {
        $string = " selected";
    }
    $countries_array[] = '<option value="' . $row["name"] . '"' . $string . '>' . $row["name"] . '</option>';
}

//query za listu svih gradova i punjenje option value-a
if (isset($_POST['cityName'])) {
    $city = $_POST['cityName'];
} else {
    $city = "";
}
$string = "";
$query = 'SELECT name FROM city';
$result = $db_instance->query($query);
$cities_array = array();
while ($row = $result->fetch_assoc()) {
    if (strcmp($row["name"], $city) == 0) {
        $string = " selected";
    }
    $cities_array[] = '<option value="' . $row["name"] . '"' . $string . '>' . $row["name"] . '</option>';
}

//dohvacanje instituteName preko POST-a i punjenje institution details->prazno ako nema POST-a
if (isset($_POST['instituteName'])) {
    $institutionName = $_POST['instituteName'];
    $query = 'SELECT institute.name AS instName,address,webAddress,isMember,president,iucRepresentative,financeContact,internationalContact,memberFrom,memberTo,comment FROM institute WHERE name=' . $institutionName;
    $result = $db_instance->query($query);
    //samo je jedan redak
    $row = $result->fetch();
    $institutionName = $row["instName"];
    $address = $row["address"];
    $webAddress = $row["webAddress"];
    $president = $row["president"];
    $financialContact = $row["financeContact"];
    $iucRepresentative = $row["iucRepresentative"];
    $memberFrom = $row["memberFrom"];
    $memberTo = $row["memberTo"];
    $other = $row["comment"];
    $internationalContact = $row["internationalContact"];
} else {
    $institutionName = "";
    $address = "";
    $webAddress = "";
    $president = "";
    $financialContact = "";
    $iucRepresentative = "";
    $other = "";
    $internationalContact = "";
}
?>

<!--- HTML code here--->

<head>
    <script src="jquery-3.4.0.min.js"></script>
</head>
<div class="row">
    <div class="col-md-20 col-md-offset-0">
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
                            <?php foreach ($tr_array as $table_row_item) {
    echo $table_row_item;
}?>
                        </tbody>
                    </table>
                </div>
                <script>
                var table = document.getElementById('dataTable'),
                    rIndex;
                for (var i = 0; i < table.rows.length; i++) {
                    table.rows[i].onclick = function() {
                        rIndex = this.rowIndex;
                        $.post("institutions.php", {
                            instituteName: this.cells[0].innerHTML,
                            countryName: this.cells[1].innerHTML,
                            cityName: this.cells[2].innerHTML
                        }, function(data, status) {
                            alert("Data: " + data + "\nStatus: " + status);
                        });
                    }
                }
                </script>
            </div>
            <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
        </div>
    </div>
    <div class="col-md-4 col-md-offset-1">
        <form method="POST" action="institutions.php" id="forma">
            <div class="form-group">
                <div class="card-header">
                    <i class="fas fa-table"></i>
                    Institution details
                </div>
                <label>Institution name</label>
                <input type="text" class="form-control" id="institutionName" value="<?php echo $institutionName; ?>">
                <label>Country</label>
                <select class="form-control" id="selectCountry">
                    <option value="">Select Country</option>
                    <?php foreach ($countries_array as $country_row) {
    echo $country_row;
}?>
                </select>
                <label>City</label>
                <select class="form-control" id="selectCity">
                    <option value="">Select City</option>
                    <?php foreach ($cities_array as $city_row) {
    echo $city_row;
}?>
                </select>
                <label>Address</label>
                <input type="text" class="form-control" id="address" value="<?php echo $address; ?>">

                <label>Web Address</label>
                <input type="text" class="form-control" id="webAddress" value="<?php echo $webAddress; ?>">

                STATUS

                <label>Reactor/president</label>
                <input type="text" class="form-control" id="president" value="<?php echo $president; ?>">

                <label>IUC Council representative</label>
                <input type="text" class="form-control" id="iucRepresentative"
                    value="<?php echo $iucRepresentative; ?>">

                <label>Financial contact</label>
                <input type="text" class="form-control" id="financialContact" value="<?php echo $financialContact; ?>">

                <label>International office contact</label>
                <input type="text" class="form-control" id="internationalContact"
                    value="<?php echo $internationalContact; ?>">

                <div class="form-group">
                    Member from <input type="date" id="memberFrom">
                </div>
                <div class="form-group">
                    Withdrawal <input type="date" id="memberTo">
                </div>
                <div class="form-group">
                    <label>Other</label>
                    <textarea class="form-control" id="other" rows="2"><?php echo $other; ?></textarea>
                </div>
                <button type="submit" name="delete" class="btn btn-danger"
                    onclick="delete($institutionName)">Delete</button>
                <button type="submit" name="update" class="btn btn-warning" onclick="delete($institutionName)">Apply
                    changes</button>
                <button type="submit" name="insert" class="btn btn-success" onclick="delete($institutionName)">Create
                    new</button>
        </form>
    </div>
</div>

<!--- Html code ends--->

<?php
html_handler::build_footer(); // BUILD THE FOOTER
?>