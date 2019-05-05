<?php
require_once './configuration.php';//ALWAYS REQUIRE CONFIGURATION . CLASS AUTOLOADER WONT WORK WITHOUT IT

$page_setup = new class_page_setup(false);


$db_instance = $page_setup->get_db_instance(); //GET DB INSTANCE SO YOU CAN USE DB FUNCTIONS


if (!empty($_POST['username']) && !empty($_POST['password'])) {

    $username = $_POST['username'];
    $password_hash = md5($_POST['password']);


    $stmt = $db_instance->prepare('SELECT
                                                * 
                                          FROM 
                                               user 
                                          WHERE 
                                                
                                                `e-mail`=?');


    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {

        $user_pw = $row['password'];

        if (($password_hash == $user_pw) && $row['active'] == 1) {

            $_SESSION['user_id'] = $row['id'];

            header("Location: dashboard.php");
        } else {
            header("Location: logout.php");
        }

    } else {
        $error = "Wrong E-mail";
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

    <title>IUC - Admin Login</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">

</head>

<body class="bg-dark">

<div class="container">
    <div class="card card-login mx-auto mt-5">
        <div class="card-header">Login</div>
        <div class="card-body">
            <form method="post">
                <div class="form-group">
                    <?php echo $error ?>
                    <div class="form-label-group">
                        <input type="email" id="inputEmail" class="form-control" placeholder="User Name"
                               required="required" name="username" autofocus="autofocus">
                        <label for="inputEmail">User Name</label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-label-group">
                        <input type="password" id="inputPassword" class="form-control" name="password"
                               placeholder="Password" required="required">
                        <label for="inputPassword">Password</label>
                    </div>
                </div>

                <input type="submit" value="Login" class="btn btn-primary btn-block">
            </form>
            <a class="btn btn-outline-primary btn-block" style="margin-top: 15px" href="forgot_password.php">Forgot Your
                Password?</a>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

</body>

</html>
