<?php

require_once './configuration.php'; //ALWAYS REQUIRE CONFIGURATION . CLASS AUTOLOADER WONT WORK WITHOUT IT

$page_setup = new class_page_setup(); // CREATE THE CLASS PAGE SETUP

$db_instance = $page_setup->get_db_instance(); //GET DB INSTANCE SO YOU CAN USE DB FUNCTIONS

$institutions_object = new class_institutions();

$all_institutions = $institutions_object->get_all_institutions();

//query za listu svih drzava i punjenje option value-a

$all_countries = class_geo::get_all_countries($db_instance);
/*
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
*/
html_handler::build_header("Course details"); //BUILD THE HEADER WITH PAGE TITLE PARAMETAR

html_handler::import_lib(".js");
$id = $_GET['id'];
if (isset($GET['id'])) {
    $query = "SELECT * FROM `eventt` WHERE id = '".$id."'";
    $result = $db_instance->query($query);
    $result->fetch_assoc();
    var_dump($result);
}

?>

<!--- HTML code here--->

<script>
$(document).ready(function() {
    $(function() {
		$("li#basic_info").click(function() {
            if($("#div_work_schedule").is(":visible")){
                $("#div_work_schedule").hide();
                $('#div_basic_info').show();
            }
            if($("#div_people").is(":visible")){
                $("#div_people").hide();
                $('#div_basic_info').show();
            }
            if($("#div_files").is(":visible")){
                $("#div_files").hide();
                $('#div_basic_info').show();
            }
            if($("#div_course_fee").is(":visible")){
                $("#div_course_fee").hide();
                $('#div_basic_info').show();
            }
		});
		$("li#work_schedule").click(function() {
			if($("#div_basic_info").is(":visible")){
				$("#div_basic_info").hide();
				$('#div_work_schedule').show();
			}
			if($("#div_people").is(":visible")){
				$("#div_people").hide();
				$('#div_work_schedule').show();
			}
            if($("#div_files").is(":visible")){
                $("#div_files").hide();
                $('#div_work_schedule').show();
            }
            if($("#div_course_fee").is(":visible")){
                $("#div_course_fee").hide();
                $('#div_work_schedule').show();
            }
		});
		$("li#people").click(function() {
			if($("#div_basic_info").is(":visible")){
				$("#div_basic_info").hide();
				$('#div_people').show();
			}
			if($("#div_work_schedule").is(":visible")){
				$("#div_work_schedule").hide();
				$('#div_people').show();
			}
            if($("#div_files").is(":visible")){
                $("#div_files").hide();
                $('#div_people').show();
            }
            if($("#div_course_fee").is(":visible")){
                $("#div_course_fee").hide();
                $('#div_people').show();
            }
		});
        $("li#files").click(function() {
            if($("#div_basic_info").is(":visible")){
                $("#div_basic_info").hide();
                $('#div_files').show();
            }
            if($("#div_work_schedule").is(":visible")){
                $("#div_work_schedule").hide();
                $('#div_files').show();
            }
            if($("#div_people").is(":visible")){
                $("#div_people").hide();
                $('#div_files').show();
            }
            if($("#div_course_fee").is(":visible")){
                $("#div_course_fee").hide();
                $('#div_files').show();
            }
        });
        $("li#course_fee").click(function() {
            if($("#div_basic_info").is(":visible")){
                $("#div_basic_info").hide();
                $('#div_course_fee').show();
            }
            if($("#div_work_schedule").is(":visible")){
                $("#div_work_schedule").hide();
                $('#div_course_fee').show();
            }
            if($("#div_people").is(":visible")){
                $("#div_people").hide();
                $('#div_course_fee').show();
            }
            if($("#div_files").is(":visible")){
                $("#div_files").hide();
                $('#div_people').show();
            }
        });
	});
});
</script>
<?php echo $id;

if(isset($_GET['id']))
{
    $query = "SELECT * FROM `eventt` WHERE id = '".$id."'";
    $result = $db_instance->query($query);
    $row = $result->fetch_assoc();
}


?>
<div class ="row my-3">
	<div class="col-md-8">
	<div class="card-header" style="width:200px">
		<i class="fas fa-table"></i>
		Course details
	</div>
        <ul class="list-inline">
			<li id="basic_info" class="list-inline-item">Basic info |</li>
			<li id="work_schedule" class="list-inline-item">Work Schedule  | </li>
			<li id="people" class="list-inline-item"> People | </li>
			<li id="files" class="list-inline-item">Files  |</li>
			<!-- <li id="course_fee" class="list-inline-item"><a class="social-icon text-xs-center" target="_blank" href="#"> Course Fee</a></li> -->
			<li id="course_fee" class="list-inline-item">Course Fee </li>
		</ul>
    </div>
	<div class="col-md-4">
		<div class="btn-group float-right mt-2" role="group">
			<button type="button" class="btn btn-md btn-success mr-2">Back to list</button>
			<button type="button" class="btn btn-md btn-info mr-2">View page</button>
			<button type="button" class="btn btn-md btn-warning">Save new item</button>
		</div>
	</div>
</div>
<div class="row" id="div_basic_info" style="visibility:visible;">
    <div class="col-md-3 col-md-offset-1">
        <form method="POST" action="institutions.php" id="forma_basic_info">
            <div class="form-group">
                <label>Title</label>
                <input type="hidden" id="formInstitutionID" value="<?php echo $row["title"] ?>" name="update_id">
                <input type="text" class="form-control" id="institutionName" name="instName" value="<?php echo $row["title"] ?>">
                <label>Subtitle</label>
                <input type="hidden" id="formInstitutionID" value="" name="update_id">
                <input type="text" class="form-control" id="institutionName" name="instName" value="<?php echo $row["subtitle"] ?>">
                <label>Course no.</label>
                <input type="hidden" id="formInstitutionID" value="" name="update_id">
                <input type="text" class="form-control" id="institutionName" name="instName" value="<?php echo $row["id"] ?>">
                <label>From</label>
                <input type="hidden" id="formInstitutionID" value="" name="update_id">
                <input type="text" class="form-control" id="institutionName" name="instName" value="<?php echo $row["start_date"] ?>">
                <label>To</label>
                <input type="hidden" id="formInstitutionID" value="" name="update_id">
                <input type="text" class="form-control" id="institutionName" name="instName" value="<?php echo $row["end_date"] ?>">
                <!--
                <div class="form-group">
					From <input type="date" id="memberFrom" name="memberFrom">
                </div>
                <div class="form-group">
                    To <input type="date" id="memberTo" name="memberTo">
                </div>
                -->
				<label class="my-1 mr-2" for="inlineFormCustomSelectPref">Languages</label>
				<div class="form-check form-check-inline">
				  <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
				  <label class="form-check-label" for="inlineCheckbox1">1</label>
				</div>
				<div class="form-check form-check-inline">
				  <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">
				  <label class="form-check-label" for="inlineCheckbox2">2</label>
				</div>
				<div class="form-check form-check-inline">
				  <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="option3">
				  <label class="form-check-label" for="inlineCheckbox3">3 </label>
				</div>
                <div></div>
				<label>Status</label>
                <select class="form-control" id="selectCountry" name="selectCountry" required>
                    <option value="" selected disabled hidden>Select Country1</option>
                    <?php
                    $query = "select * from country";
                    $result = $db_instance->query($query);
                    while ($country = $result->fetch_assoc()) {
                        echo '<option value="'.$country["title"].'" selected disabled hidden>Select Country</option>';
                        echo '<option>'.$country["name"].'</option>';
                    }
                    ?>
                </select>
                <label>Academic year</label>
                    <select class="form-control" id="selectCountry" name="selectCountry" required>
									<option value="" selected disabled hidden>Select Country2</option>
                        <?php
                        $query = "select * from cycle";
                        $result = $db_instance->query($query);
                        while ($years = $result->fetch_assoc()) {
                            echo '<option value="'.$years["title"].'" selected disabled hidden>Select Country</option>';
                            echo '<option>'.$years["title"].'</option>';
                        }
				?>
                </select>
				<label>Item participants</label>
                <input type="hidden" id="formInstitutionID" value="" name="update_id">
                <input type="text" class="form-control" id="institutionName" name="instName" value="<?php echo $row["numUnregParticipants"];?>">
			</div>
		</form>
		</div>
		<div class="col-md-9 col-md-offset-0">
			<form action="/action_page.php">
				<div class="form-group">
					<label for="comment">Course description:</label>
					<textarea class="form-control" rows="5" id="comment" name="text"><?php echo $row["description"];?></textarea>
				</div>
				<button type="submit" class="btn btn-primary">Submit</button>
			</form>
		</div>
	</div>
<div class="row" id="div_work_schedule" style="display: none;">
	<div class="col-md-9 col-md-offset-0">
		<form action="/action_page.php">
			<div class="form-group">
				<label for="comment">Work Schedule:</label>
				<textarea class="form-control" rows="9" id="comment" name="text"><?php echo $row["workschedule"]; ?></textarea>
			</div>
			<button type="submit" class="btn btn-primary">Submit</button>
		</form>
	</div>
</div>
<div class="row" id="div_people" style="display:none;">
	<div class="col-md-3 d-flex flex-column justify-content-between">
		<div class="p-2 mb-auto">Directors</div>
		<div class="p-2">
			<button type="button" class="btn btn-m btn-primary">Edit details</button>
			<button type="button" class="btn btn-danger">Delete selected</button>
			<button type="button" class="btn btn-success">Create new</button>
		</div>
	</div>
	<div class="col-md-9">
			<div class="card mb-3">
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
							<thead>
								<tr>
                                    <th scope="col">Firstname</th>
                                    <th scope="col">Lastname</th>
									<th scope="col">Country</th>
									<th scope="col">Institution</th>
									<th scope="col">Participation</th>
								</tr>
							</thead>

							<tbody>
								<?php /*foreach ($all_institutions as $row) {
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
	*/?>
							<tr>
								<td>Random1</td>
								<td>Random2</td>
								<td>Random3</td>
								<td>Random4</td>
								<td>Random5</td>

							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
    <div class="col-md-3 d-flex flex-column justify-content-between">
        <div class="p-2 mb-auto">Lecturers</div>
        <div class="p-2">
            <button type="button" class="btn btn-m btn-primary">Edit details</button>
            <button type="button" class="btn btn-danger">Delete selected</button>
            <button type="button" class="btn btn-success">Create new</button>
        </div>
    </div>
    <div class="col-md-9">
        <div class="card mb-3">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th scope="col">Firstname</th>
                            <th scope="col">Lastname</th>
                            <th scope="col">Country</th>
                            <th scope="col">Institution</th>
                            <th scope="col">Participation</th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php /*foreach ($all_institutions as $row) {
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
	*/?>
                        <tr>
                            <td>Random1</td>
                            <td>Random2</td>
                            <td>Random3</td>
                            <td>Random4</td>
                            <td>Random5</td>

                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 d-flex flex-column justify-content-between">
        <div class="p-2 mb-auto">Participants</div>
        <div class="p-2">
            <button type="button" class="btn btn-m btn-primary">Edit details</button>
            <button type="button" class="btn btn-danger">Delete selected</button>
            <button type="button" class="btn btn-success">Create new</button>
        </div>
    </div>
    <div class="col-md-9">
        <div class="card mb-3">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th scope="col">Firstname</th>
                            <th scope="col">Lastname</th>
                            <th scope="col">Country</th>
                            <th scope="col">Institution</th>
                            <th scope="col">Participation</th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php /*foreach ($all_institutions as $row) {
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
	*/?>
                        <tr>
                            <td>Random1</td>
                            <td>Random2</td>
                            <td>Random3</td>
                            <td>Random4</td>
                            <td>Random5</td>
                           
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row" id="div_people" style="display:none;">
    <div class="col-md-3 d-flex flex-column justify-content-between">
        <div class="p-2 mb-auto">Directors</div>
        <div class="p-2">
            <button type="button" class="btn btn-m btn-primary">Edit details</button>
            <button type="button" class="btn btn-danger">Delete selected</button>
            <button type="button" class="btn btn-success">Create new</button>
        </div>
    </div>
    <div class="col-md-9">
        <div class="card mb-3">
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
                        <?php /*foreach ($all_institutions as $row) {
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
	*/?>
                        <tr>
                            <td>Random1</td>
                            <td>Random2</td>
                            <td>Random3</td>
                            <td>Random4</td>
                            <td>Random5</td>
                            <td>Random6</td>
                            <td>Random7</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 d-flex flex-column justify-content-between">
        <div class="p-2 mb-auto">Lecturers</div>
        <div class="p-2">
            <button type="button" class="btn btn-m btn-primary">Edit details</button>
            <button type="button" class="btn btn-danger">Delete selected</button>
            <button type="button" class="btn btn-success">Create new</button>
        </div>
    </div>
    <div class="col-md-9">
        <div class="card mb-3">
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
                        <?php /*foreach ($all_institutions as $row) {
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
	*/?>
                        <tr>
                            <td>Random1</td>
                            <td>Random2</td>
                            <td>Random3</td>
                            <td>Random4</td>
                            <td>Random5</td>
                            <td>Random6</td>
                            <td>Random7</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 d-flex flex-column justify-content-between">
        <div class="p-2 mb-auto">Participants</div>
        <div class="p-2">
            <button type="button" class="btn btn-m btn-primary">Edit details</button>
            <button type="button" class="btn btn-danger">Delete selected</button>
            <button type="button" class="btn btn-success">Create new</button>
        </div>
    </div>
    <div class="col-md-9">
        <div class="card mb-3">
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
                        <?php /*foreach ($all_institutions as $row) {
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
	*/?>
                        <tr>
                            <td>Random1</td>
                            <td>Random2</td>
                            <td>Random3</td>
                            <td>Random4</td>
                            <td>Random5</td>
                            <td>Random6</td>
                            <td>Random7</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="row" id="div_files" style="display:none;">
    <div class="col-md-3 d-flex flex-column justify-content-between">
        <div class="p-2 mb-auto">Course pictures</div>
        <div class="p-2">
            <button type="button" class="btn btn-m btn-primary">Edit details</button>
            <button type="button" class="btn btn-danger">Delete selected</button>
            <button type="button" class="btn btn-success">Create new</button>
        </div>
    </div>
    <div class="col-md-9">
        <div class="card mb-3">
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
                        <?php /*foreach ($all_institutions as $row) {
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
	*/?>
                        <tr>
                            <td>Random1</td>
                            <td>Random2</td>
                            <td>Random3</td>
                            <td>Random4</td>
                            <td>Random5</td>
                            <td>Random6</td>
                            <td>Random7</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 d-flex flex-column justify-content-between">
        <div class="p-2 mb-auto">Documents for download</div>
        <div class="p-2">
            <button type="button" class="btn btn-m btn-primary">Edit details</button>
            <button type="button" class="btn btn-danger">Delete selected</button>
            <button type="button" class="btn btn-success">Create new</button>
        </div>
    </div>
    <div class="col-md-9">
        <div class="card mb-3">
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
                        <?php /*foreach ($all_institutions as $row) {
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
	*/?>
                        <tr>
                            <td>Random1</td>
                            <td>Random2</td>
                            <td>Random3</td>
                            <td>Random4</td>
                            <td>Random5</td>
                            <td>Random6</td>
                            <td>Random7</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 d-flex flex-column justify-content-between">
        <div class="p-2 mb-auto">Related links</div>
        <div class="p-2">
            <button type="button" class="btn btn-m btn-primary">Edit details</button>
            <button type="button" class="btn btn-danger">Delete selected</button>
            <button type="button" class="btn btn-success">Create new</button>
        </div>
    </div>
    <div class="col-md-9">
        <div class="card mb-3">
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
                        <?php /*foreach ($all_institutions as $row) {
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
	*/?>
                        <tr>
                            <td>Random1</td>
                            <td>Random2</td>
                            <td>Random3</td>
                            <td>Random4</td>
                            <td>Random5</td>
                            <td>Random6</td>
                            <td>Random7</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row ml-3" id="div_course_fee" style="display:none;">
    <div class="col-md-12">
        <form>
            <div class="form-group">
                <label for="exampleInputEmail1">GCF (EUR)</label>
                <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="550">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Paid amount</label>
                <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="0">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
                <label for="exampleFormControlSelect1">Valute</label>
                <select class="form-control" id="exampleFormControlSelect1">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                </select>
            </div>
            <div class="form-check">
                <label class="form-check-label" for="exampleCheck1">Waiver</label>
                <input type="checkbox" class="form-check-input ml-3" id="exampleCheck1">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Participation fee (EUR)</label>
                <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="40">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
<div>
</div>
<!--- Html code ends--->
<?php

html_handler::build_footer(); // BUILD THE FOOTER

?>
