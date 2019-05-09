<?php

require_once './configuration.php'; //ALWAYS REQUIRE CONFIGURATION . CLASS AUTOLOADER WONT WORK WITHOUT IT

$page_setup = new class_page_setup(); // CREATE THE CLASS PAGE SETUP
html_handler::build_header("List of institutions"); //BUILD THE HEADER WITH PAGE TITLE PARAMETAR
$db_instance = $page_setup->get_db_instance(); //GET DB INSTANCE SO YOU CAN USE DB FUNCTIONS

//provjerava status od membera i zamjenjuje to u tablici sa odgovarajućim stringom(Y=Member,N=Associate Member)
function checkMemberStatus($member)
{
    if ($member == 'Y') {
        return "Member";
    } else {
        return "Associate Member";
    }

}
//radi obrnuto od checkMemberStatus funkcije koja je opisana poviše
function revertMemberStatus($member)
{
    if ($member == 'Member') {
        return "Y";
    } else {
        return "N";
    }

}
//Query za punjenje tablice
$query = 'SELECT institute.id AS instId,currency.name AS currencyName,institute.name AS instName,city.name AS cityName,city.id AS cityId,country.name AS countryName,country.id AS countryId,SUM(paidAmount) AS suma,webAddress,isMember,memberTo FROM institute JOIN city ON institute.cityId=city.id LEFT JOIN member_payment ON institute.id=instituteId JOIN country ON city.countryId=country.id LEFT JOIN currency ON currency.id=member_payment.currencyId WHERE institute.aktivan=1 GROUP BY institute.id';
$result = $db_instance->query($query);
$tr_array = array();
while ($row = $result->fetch_assoc()) {
    //provjera je li se member povukao iz sustava, ako jest prikazat ce datum izlaska, ako nije prikazat ce prazan string
    //mozda se moze stavit default vrijednost null na  ako se ne upise withdrawal pri unosu/izmjeni
    //$string = $row["memberTo"];
    //if ($row["memberTo"] == "0000-00-00") {
    //  $string = '';
    //}
    //punjenje tablice s rezultatima
    //ukupnu valutu ce samo dobro izracunati ako ta institucija placa uvijek u istoj valuti, ako ne placa sigurno nece, a nisam siguran koja će valuta biti prikazana, ja mislim prva koju nađe
    //ukupnu valutu ce samo dobro izracunati ako ta institucija placa uvijek u istoj valuti, ako ne placa sigurno nece, a nisam siguran koja će valuta biti prikazana, ja mislim prva koju nađe
    //ukupnu valutu ce samo dobro izracunati ako ta institucija placa uvijek u istoj valuti, ako ne placa sigurno nece, a nisam siguran koja će valuta biti prikazana, ja mislim prva koju nađe
    //ukupnu valutu ce samo dobro izracunati ako ta institucija placa uvijek u istoj valuti, ako ne placa sigurno nece, a nisam siguran koja će valuta biti prikazana, ja mislim prva koju nađe
    //ukupnu valutu ce samo dobro izracunati ako ta institucija placa uvijek u istoj valuti, ako ne placa sigurno nece, a nisam siguran koja će valuta biti prikazana, ja mislim prva koju nađe
    //ukupnu valutu ce samo dobro izracunati ako ta institucija placa uvijek u istoj valuti, ako ne placa sigurno nece, a nisam siguran koja će valuta biti prikazana, ja mislim prva koju nađe
    //ukupnu valutu ce samo dobro izracunati ako ta institucija placa uvijek u istoj valuti, ako ne placa sigurno nece, a nisam siguran koja će valuta biti prikazana, ja mislim prva koju nađe
    $tr_array[] = '<tr class="institutionRow" data-instID="' . $row['instId'] . '" data-cityid="' . $row['cityId'] . '" data-countryid="' . $row['countryId'] . '">
    <td>' . $row["instName"] . '</td>
    <td>' . $row["cityName"] . '</td>
    <td>' . $row["countryName"] . '</td>
    <td>' . checkMemberStatus($row["isMember"]) . '</td>
    <td>' . $row["suma"] . " " . $row["currencyName"] . '</td>
    <td>' . $row["webAddress"] . '</td>
    <td>' . $row["memberTo"] . '</td>
    </tr>';
}
//query za listu svih drzava i punjenje option value-a
$query = 'SELECT name,id FROM country';
$result = $db_instance->query($query);
$countries_array = array();
while ($row = $result->fetch_assoc()) {
    $countries_array[] = '<option value="' . $row["id"] . '">' . $row["name"] . '</option>';
}

//u slucaju pritiska na Apply Changes ili Create new
//provjera koji fieldovi ne smiju biti prazni IME,DRZAVA,GRAD,STATUS
if (!empty($_POST["instName"]) && isset($_POST["update_button"]) || isset($_POST["insert_button"]) && !empty($_POST["selectCity"]) && !empty($_POST["selectCountry"]) && !empty($_POST["selectStatus"])) {
    var_dump($_POST);
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

}
//stalno mi posta poslije svakog refresha, jer se POST ne prazni, i ne pokazuje novi data nego tek nakon refresha
//stalno mi posta poslije svakog refresha, jer se POST ne prazni, i ne pokazuje novi data nego tek nakon refresha
//stalno mi posta poslije svakog refresha, jer se POST ne prazni, i ne pokazuje novi data nego tek nakon refresha
//stalno mi posta poslije svakog refresha, jer se POST ne prazni, i ne pokazuje novi data nego tek nakon refresha
//stalno mi posta poslije svakog refresha, jer se POST ne prazni, i ne pokazuje novi data nego tek nakon refresha
//stalno mi posta poslije svakog refresha, jer se POST ne prazni, i ne pokazuje novi data nego tek nakon refresha
//stalno mi posta poslije svakog refresha, jer se POST ne prazni, i ne pokazuje novi data nego tek nakon refresha
//header('Location:institutions.php');
?>

<!--- HTML code here--->

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
<script>
$(document).ready(function() {
    //globalna varijabla za oznaceni redak
    var selectedInst;
    //resetiranje cijele forme na pocetnu
    $('#reset').on('click', function() {
        $("#institutionName").val("");
        $("#selectCountry").val("").change();
        $("#selectCity").val("").change();
        $("#address").val("")
        $("#webAddress").val("");
        $("#president").val("");
        $("#iucRepresentative").val("");
        $("#financialContact").val("");
        $("#internationalContact").val("");
        $("#memberFrom").val("");
        $("#memberTo").val("");
        $("#other").val("");
        //namjestanje buttona
        $('#delete').attr("disabled", true);
        $('#update').attr("disabled", true);
        $('#reset').attr("type", "hidden");
        $('#insert').removeAttr('disabled');
        //sakrivena forma se stavlja na prazno
        $("#formInstitutionID").val("");
    });
    //ajax za dinamične select boxove, grad select box ovisi o tom koja ce se drzava izabrati, inace ce bit prazan
    $('#selectCountry').change(function() {
        var country_id = $(this).val();
        $.ajax({
            url: "institutionsAjax.php",
            method: "POST",
            data: {
                post_inst_id: country_id,
                action: "getCities"
            },
            dataType: "text",
            success: function(data) {
                $('#selectCity').html(data);
            }
        });
    });
    //ajax za dohvacanje vise informacija o retku nakon klika na bilo gdje u tom retku
    $('.institutionRow').on('click', function() {
        var cityId = $(this).data("cityid");
        var countryId = $(this).data("countryid");
        var instID = $(this).data("instid");
        //stavljanje hidden ID-a u formi na ID selectanog retka koji se kasnije koristi u POSTU na klikom CREATE NEW
        $("#formInstitutionID").val(instID);
        selectedInst = instID;
        $.post(
            "institutionsAjax.php", {
                post_inst_id: instID,
                action: "getData"
            },
            function(data, status) {
                var podaci = JSON.parse(data);
                $("#institutionName").val(podaci.name);
                $("#selectCountry").val(countryId).change();
                $("#selectCity").val(cityId).change();
                $("#address").val(podaci.address);
                $("#webAddress").val(podaci.webAddress);
                //ponovno sam napisao jer ne dohvaca funkciju od gore checkMemberStatus()
                if (podaci.isMember == 'Y')
                    $("#selectStatus").val("Member").change();
                else
                    $("#selectStatus").val("Associate Member").change();
                $("#president").val(podaci.president);
                $("#iucRepresentative").val(podaci.iucRepresentative);
                $("#financialContact").val(podaci.financeContact);
                $("#internationalContact").val(podaci.internationalContact);
                $("#memberFrom").val(podaci.memberFrom);
                $("#memberTo").val(podaci.memberTo);
                $("#other").val(podaci.comment);
                //namjestanje buttona
                $('#delete').removeAttr('disabled');
                $('#update').removeAttr('disabled');
                $('#insert').attr("disabled", true);
                $('#reset').attr("type", "show");
            });
    });
    //ajax za mijenjanje atributa active u 0, tj sakrivanje(lazno brisanje)
    $('#delete').on('click', function() {
        var instID = selectedInst;
        var confirmation = confirm("Are you sure you want to delete?");
        if (confirmation) {
            $.post("institutionsAjax.php", {
                    post_inst_id: instID,
                    action: "delete"
                },
                function(data, status) {
                    alert("Institution deleted");
                    $("#institutionName").val("");
                    $("#selectCountry").val("").change();
                    $("#selectCity").val("").change();
                    $("#address").val("")
                    $("#webAddress").val("");
                    $("#president").val("");
                    $("#iucRepresentative").val("");
                    $("#financialContact").val("");
                    $("#internationalContact").val("");
                    $("#memberFrom").val("");
                    $("#memberTo").val("");
                    $("#other").val("");
                    $('#delete').attr("disabled", true);
                    $('#update').attr("disabled", true);
                    //sakrivena forma se stavlja na prazno
                    $("#formInstitutionID").val("");
                });
        }
    });
})
</script>