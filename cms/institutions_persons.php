<?php


require_once './configuration.php';//ALWAYS REQUIRE CONFIGURATION . CLASS AUTOLOADER WONT WORK WITHOUT IT

$page_setup = new class_page_setup(); // CREATE THE CLASS PAGE SETUP

$db_instance = $page_setup->get_db_instance(); //GET DB INSTANCE SO YOU CAN USE DB FUNCTIONS

html_handler::build_header("Instituions and persons"); //BUILD THE HEADER WITH PAGE TITLE PARAMETAR<?php

//select za institucije coutnry i ljudi koji su iz tih institucija bili na nekom eventu
$query = 'SELECT institute.id AS instId,
                institute.name as InstitutionName,
                country.name as CountryName,
                COUNT(person.id) as ljudi
                    FROM institute
                    JOIN city on institute.cityid=city.id
                    JOIN country on city.countryid=country.id
                    JOIN person on institute.id=person.instituteid
                    join person_event_role on person.id = person_event_role.personId
                    join role on person_event_role.roleid= role.id
                    join eventt on person_event_role.eventId = eventt.id
                    join eventtype on eventt.typeId = eventtype.id
                    WHERE institute.aktivan = 1
                    GROUP BY institute.id';
$result = $db_instance->query($query);
$inst_person_array = array();
while ($row = $result->fetch_assoc()) {
    $inst_person_array[] = $row;
}



html_handler::import_lib("institutions_persons.js");
?>
<!--- HTML code here--->


<div class="row">
    <div class="col-md-12 col-md-offset-0">
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
                            <th>Institution</th>
                            <th>Country</th>
                            <th>Persons</th>
                            <th>Button</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Institution</th>
                            <th>Country</th>
                            <th>Persons</th>
                            <th>Button</th>

                        </tr>
                        </tfoot>

                        <tbody>
                        <?php
                        foreach ($inst_person_array as $row){
                            echo '<tr class="InstPersRow" data-instID="' . $row['instId'] . '" ">
                                            <td>'.$row["InstitutionName"].'</td>
                                            <td>'.$row["CountryName"].'</td>
                                            <td>'.$row["ljudi"].'</td>
                                            <td><input type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal" name="modal_button" value="Participation"></input></td>
                                            </tr>';}
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
            <input type="text" class="form-control" id="LastName" name="LaName" value="">
        </div>
    </div>
</div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" >&times;</button>
                <h4 class="modal-title">Participation from institution</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 col-md-offset-0">
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
                                            <th>Name</th>
                                            <th>Role</th>
                                            <th>Type</th>
                                            <th>Date</th>
                                            <th>Programme</th>
                                        </tr>
                                        </thead>
                                        <tfoot>
                                        <tr>
                                            <th>Name</th>
                                            <th>Role</th>
                                            <th>Type</th>
                                            <th>Date</th>
                                            <th>Programme</th>
                                        </tr>
                                        </tfoot>
                                        <tbody id="mydata">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
<!--- HTML code here--->


<?php
html_handler::build_footer();// BUILD THE FOOTER
?>

