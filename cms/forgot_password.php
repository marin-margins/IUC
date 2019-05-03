<?php
/**
 * Created by PhpStorm.
 * User: Ez01
 * Date: 03/05/2019
 * Time: 09:16
 */

require "configuration.php"; //ALWAYS REQUIRE CONFIGURATION . CLASS AUTOLOADER WONT WORK WITHOUT IT

$page_setup = new class_page_setup();


$db_instance = $page_setup->get_db_instance(); //GET DB INSTANCE SO YOU CAN USE DB FUNCTIONS

$mail_handler = new class_mail_handler();



$hash_key = $_GET['hash_key'];

if(!empty($_POST['forgot_password'])){

    $forgot_mail = $_POST['forgot_mail'];


    $stmt = $db_instance->prepare('SELECT
                                                * 
                                          FROM 
                                               user 
                                          WHERE 
                                                `e-mail`=?');


    $stmt->bind_param("s", $forgot_mail);
    $stmt->execute();
    $result = $stmt->get_result();


    if( $result->num_rows === 0){

        $error = "E-mail not valid";

    }else{
        $error = "Activation Mail Sent, and expires in 20 minutes";

        $hash = md5(uniqid(rand(), true));

        $stmt = $db_instance->prepare("UPDATE 
                                                  user 
                                              SET 
                                                  forgot_hash = ?,
                                                  forgot_expires = ?
                                              WHERE 
                                                    `e-mail` = ?");


        $stmt->bind_param("sss", $hash, class_debug::get_time("+20 minutes"),$forgot_mail);
        $stmt->execute();
        $stmt->close();


        $msg_html = "<h5>This is automatic e-mail regarding forgot your password request by user ".$forgot_mail."</h5>
                        <h4>To reset your password please follow the following link  https://</h4>";


        $mail_handler->setup_parameters("iuc_dev_test@iuc.hr","Iuc Dev Team","IUC Forgot Password","");




    }

}








?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Forgot Passowrd</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">

</head>

<body class="bg-dark">

<?php
if(empty($hash_key)) {


    ?>

    <div class="container">
        <div class="card card-login mx-auto mt-5">
            <div class="card-header">Login</div>
            <div class="card-body">
                <form method="post" name="forgot_pw">
                    <h5 style="color: #6d6126;"><?php echo $error ?></h5>
                    <div class="form-group">
                        <div class="form-label-group">



                            <input type="email" id="inputEmail" class="form-control" placeholder="User Name"
                                   required="required" name="forgot_mail" autofocus="autofocus">
                            <label for="inputEmail">E-mail</label>
                        </div>
                    </div>

                    <input type="submit" name="forgot_password" value="Forgot Password" class="btn btn-primary btn-block">
                </form>

            </div>
        </div>
    </div>
    <?php
}else{
?>

    <div class="container">
        <div class="card card-login mx-auto mt-5">
            <div class="card-header">Login</div>
            <div class="card-body">
                <form method="post" name="forgot_pw">


                    <div class="form-group">
                        <div class="form-label-group">
                            <input type="text" id="inputEmail" class="form-control" placeholder="User Name"
                                   required="required" name="username" autofocus="autofocus">
                            <label for="inputEmail">New Password</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-label-group">
                            <input type="text" id="inputEmail" class="form-control" placeholder="User Name"
                                   required="required" name="username" autofocus="autofocus">
                            <label for="inputEmail">Repeat Password</label>
                        </div>
                    </div>

                    <input type="submit" name="new_password" value="Save New Password" class="btn btn-primary btn-block">
                </form>

            </div>
        </div>
    </div>






<?php
}
  ?>





<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

</body>

</html>
<?php




