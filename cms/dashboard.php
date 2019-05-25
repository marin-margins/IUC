<?php
require_once './configuration.php';//ALWAYS REQUIRE CONFIGURATION . CLASS AUTOLOADER WONT WORK WITHOUT IT

$page_setup = new class_page_setup(); // CREATE THE CLASS PAGE SETUP

$db_instance = $page_setup->get_db_instance(); //GET DB INSTANCE SO YOU CAN USE DB FUNCTIONS


// ---------------PHP CODE ------------------


// ---------------FILE UPLOAD EXAMPLE ------------------

if(!empty($_FILES)){

$file_upload_return_message= class_file_upload::upload_file($_FILES["files"],"test_file_upload_dir");

}







// ---------------FILE UPLOAD EXAMPLE end ------------------


// --------------- BOTTOM OF PHP CODE  ------------------
//build header and includes must be in the bottom of the first php script
html_handler::build_header("Dashboard"); //BUILD THE HEADER WITH PAGE TITLE PARAMETAR

html_handler::import_lib("example.js");

html_handler::import_lib("example.css");
?>

<!--- HTML code here--->

<h1 style="color:#00e3ff"> New framework update:</h1>
<h5 style="color:#00e3ff">Added static method: <b> html_handler::import_lib("example.css");</b> for including libraries . all libraries must be in the js or css folder <b>WORKS WITH JS AND CSS</b>  </h5>


<h5 style="color:#00e3ff"> Added AJAX folder for all ajax files </h5>


<h5 style="color:red"> IMPORTANT!!!! </h5>
<h5 style="color:red"> see this files code for example </h5>

<h5 style="color:#00e8ff"> Build header static function must be  right before closing first ?> php script cause other headers wont work</h5>
<h5 style="color:#00e3ff">html_handler::import_lib(""); method must be after the build header function !!!!!!!!!!!!!</h5>
<hr><hr>
<h3 style="color: #a30000;">##############################____CORE UPDATE 25/5/2019______###################################</h3><hr>
<h5 style="color:#00e3ff"> Dodana static metoda za upload fileova . Metoda prima 1 file ili listu fileova. </h5>
<h5 style="color:#00e3ff"> Ispod imate formu koja prima listu fileova i mozete je kopirat. obratite na enctype i arraj name="files[]" i atribut multiple. to omogucava vise fileova   </h5>
<h5 style="color:#00e3ff">
        Obratite pozornost na echo "<>".$file_upload_return_message."<>" koji ispisuje erore ili successove ako se fileovi uploadaju.
        slobodno testirajte metodu
    </h5>
<h5 style="color:#00e3ff">
        Kako bih uploadali file molim pogledajte sto prima funkcija. sve je objasnjeno u class_file_upload.
        molim stvorite folder ko sto je test_file_upload_dir u folderu files.
 </h5>

<h5 style="color:#00e3ff">
 Primjer kako uploadat file je u dashboard.php.!!!!!!!
</h5>




<!---File upload form--->
<div class="col-md-3">
<form  method="post" enctype="multipart/form-data">
    <br />

    <input   name="files[]" type="file" multiple /><br />

    <input type="submit" class="btn-primary btn" value="Upload Files" />
</form></div>

<?php
echo "<h2>".$file_upload_return_message."</h2>";
?>
<!--- Html code ends--->
<?php
html_handler::build_footer();// BUILD THE FOOTER
?>


