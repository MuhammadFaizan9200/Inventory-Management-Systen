<?php
session_start();
include("headers/connect.php");

if ($_POST) {
        $email = $_POST['email'];
        $password = $_POST['password'];
    
        $query = "SELECT * from `user` where email = '{$email}' AND password like '{$password}'"
        or die('error2');
        $stmh = $dbh->prepare($query);
        $stmh->execute();
       // var_dump($query);
        $row = $stmh->fetch(PDO::FETCH_ASSOC);
        $count = $stmh->rowCount(); 
         $login_status = $row['login_status'];
        $user_id = $row['user_id'];
         $user_level = $row['user_level'];
        if ($count >= 1) {
            
            $query_update = "UPDATE `user` SET `login_popup`= 1 WHERE user_id =$user_id";
            $stt = $dbh->prepare($query_update);
            $stt->execute(); 

            $_SESSION['user_id'] = $user_id;
            $_SESSION['user_level'] = $user_level;
             echo "<script>window.location.href = 'index.php';</script>";
                   
            }
            else {
            $error = '<div class="alert alert-danger" style="margin-bottom: 0px;">
				Invalid  email or password
				</div>';
        }
    }
?>

<!DOCTYPE html>

<html lang="en" class="material-style layout-fixed">


<!-- Mirrored from srthemesvilla.com/items/bhumlu-admin/default/pages_authentication_login-v2.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 02 May 2019 18:25:46 GMT -->
<head>
    <title>Login | Ahmed Traders</title>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="Bhumlu Bootstrap admin template made using Bootstrap 4, it has tons of ready made feature, UI components, pages which completely fulfills any dashboard needs." />
    <meta name="keywords" content="Bhumlu, bootstrap admin template, bootstrap admin panel, bootstrap 4 admin template, admin template">
    <meta name="author" content="Srthemesvilla" />
    <link rel="icon" type="image/x-icon" href="">

    <!-- Google fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">

    <!-- Icon fonts -->
    <link rel="stylesheet" href="assets/fonts/fontawesome.css">
    <link rel="stylesheet" href="assets/fonts/ionicons.css">
    <link rel="stylesheet" href="assets/fonts/linearicons.css">
    <link rel="stylesheet" href="assets/fonts/open-iconic.css">
    <link rel="stylesheet" href="assets/fonts/pe-icon-7-stroke.css">
    <link rel="stylesheet" href="assets/fonts/feather.css">

    <!-- Core stylesheets -->
    <link rel="stylesheet" href="assets/css/bootstrap-material.css">
    <link rel="stylesheet" href="assets/css/shreerang-material.css">
    <link rel="stylesheet" href="assets/css/uikit.css">

    <!-- Libs -->
    <link rel="stylesheet" href="assets/libs/perfect-scrollbar/perfect-scrollbar.css">
    <!-- Page -->
    <link rel="stylesheet" href="assets/css/pages/authentication.css">
</head>

<body style="background-repeat: no-repeat;
		    background-position: center;
		    background-size: cover;
		    width: 100%;
		    height: 100%;">
    <!-- [ Preloader ] Start -->
    <div class="page-loader">
        <div class="bg-primary"></div>
    </div>
    <!-- [ Preloader ] End -->

    <!-- [ Content ] Start -->
    <div class="authentication-wrapper authentication-2 ui-bg-cover ui-bg-overlay-container px-4" style="">
        <div class="ui-bg-overlay bg-dark opacity-25"></div>

        <div class="authentication-inner py-5">

            <div class="card">
                <div class="p-4 p-sm-5">
                    <!-- [ Logo ] Start -->
                    <div class="d-flex justify-content-center align-items-center pb-2 mb-4">
                                <img src="assets/logo.png" alt="Brand Logo" class="img-fluid">
                                <div class="clearfix"></div>
                    </div>
                    <!-- [ Logo ] End -->

                    <h5 class="text-center text-muted font-weight-normal mb-4">Login to Your Account</h5>
                    	<?php
                    		echo @$error;
                    	?>
                    	<br>
                    <!-- Form -->
                    <form method="post">
                        <div class="form-group">
                            <label class="form-label">Email</label>
                            <input type="text" class="form-control" name="email">
                            <div class="clearfix"></div>
                        </div>
                        <div class="form-group">
                            <span>Password</span>
                            <input type="password" class="form-control" name="password">
                            <div class="clearfix"></div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center m-0">
                            <label class="custom-control">
                                <input type="hidden" class="">
                                <input type="hidden" class="">
                                <span class=""></span>
                            </label>
                            <button type="submit" class="btn btn-primary">Sign In</button>
                        </div>
                    </form>
                    <!-- [ Form ] End -->

                </div>
            </div>

        </div>
    </div>
    <!-- / Content -->

    <!-- Core scripts -->
    <script src="assets/js/pace.js"></script>
    <script src="assets/js/jquery-3.3.1.min.js"></script>
    <script src="assets/libs/popper/popper.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/sidenav.js"></script>
    <script src="assets/js/layout-helpers.js"></script>
    <script src="assets/js/material-ripple.js"></script>



</body>


<!-- Mirrored from srthemesvilla.com/items/bhumlu-admin/default/pages_authentication_login-v2.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 02 May 2019 18:25:46 GMT -->
</html>

