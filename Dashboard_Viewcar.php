<?php
    session_start();
   // var_dump($_SESSION['user_id2']);
    //die();

    if(!isset($_SESSION['user_id2'])){

        header("Location: login.php");
    }

     require "PHP/Car.php";

    $car = new Car();

    $rows = $car->get_all_cars($_SESSION['user_id2']);
    
    foreach($rows as $row){
        $_SESSION['user_id'] = $row['user_id'];
    }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="vendors/images/users/CarSecureLogo.png">
    <title>Car Authentication</title>
    <!-- Bootstrap Core CSS -->
    <link href="CSS/bootstrap.min.css" rel="stylesheet">
    <!-- Menu CSS -->
    <link href="CSS/sidebar-nav.min.css" rel="stylesheet">
    <!-- animation CSS -->
    <link href="CSS/animate.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="CSS/style.css" rel="stylesheet">
    <!-- color CSS -->
    <link href="CSS/default.css" id="theme" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" id="theme" rel="stylesheet">
</head>

<body class="fix-header">
    <!-- ============================================================== -->
    <!-- Preloader -->
    <!-- ============================================================== -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
        </svg>
    </div>
    <!-- ============================================================== -->
    <!-- Wrapper -->
    <!-- ============================================================== -->
    <div id="wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <nav class="navbar navbar-default navbar-static-top m-b-0">
            <div class="navbar-header">
                <div class="top-left-part">
                    <!-- Logo -->
                    <a class="logo" href="Dashboard.php">
                            <img src="IMG/CarSecureLogo.png" alt="home" class="dark-logo" /><!--This is light logo text--><img src="IMG/CarSecureLogo.png" alt="home" class="light-logo" />
                         </span> </a>
                </div>
                <!-- /Logo -->
                <ul class="nav navbar-top-links navbar-right pull-right">
                    <li>
                        <a class="profile-pic" href="#"><b class="hidden-xs">Mayorwa Daniel</b></a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-header -->
            <!-- /.navbar-top-links -->
            <!-- /.navbar-static-side -->
        </nav>
        <!-- End Top Navigation -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav slimscrollsidebar">
                <div class="sidebar-head">
                    <h3><span class="fa-fw open-close"><i class="ti-close ti-menu"></i></span> <span class="hide-menu">Navigation</span></h3>
                </div>
                <ul class="nav" id="side-menu">
                    <li style="padding: 70px 0 0;">
                        <a href="Dashboard.php" class="waves-effect"><i class="fa fa-clock-o fa-fw" aria-hidden="true"></i>Dashboard</a>
                    </li>
                    <li>
                        <a href="#" class="waves-effect"><i class="fa fa-user fa-fw" aria-hidden="true"></i>Profile</a>
                    </li>
                    <li>
                        <a href="Dashboard-regcar.php" class="waves-effect"><i class="fa fa-table fa-fw" aria-hidden="true"></i>Register Car</a>
                    </li>
                    <li>
                            <a href="Dashboard_Viewcar.php" class="waves-effect"><i class="fa fa-binoculars fa-fw" aria-hidden="true"></i>View Cars</a>
                        </li>
                        <li>
                            <a href="Dashboard_edit.php" class="waves-effect"><i class="fa fa-pencil fa-fw" aria-hidden="true"></i>Edit Car Status</a>
                        </li>
                </ul>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Left Sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page Content -->
        <!-- ============================================================== -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">List Of Cars</h4> </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        
                        <ol class="breadcrumb">
                            <li><a href="#">Dashboard</a></li>
                            <li class="active">List of cars</li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- row -->
                <?php foreach($rows as $row) { ?>
                <div class="row">
                    <div class="col-md-4 col-xs-12">
                        <div class="white-box">
                            <div class="user-bg"> <?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $result['image'] ).'"/>'; ?>
                                <div class="overlay-box">
                                    <div class="user-content">
                                        <h4 class="text-white"><?php echo $row['car_plate_no'] ?></h4>
                                        <h5 class="text-white"><?php echo $row['car_chassis'] ?></h5> </div>
                                </div>
                            </div>
                            <div class="user-btm-box">
                                <div class="col-md-12 col-sm-12 text-center">
                                    <p class="text-purple"><i class="ti-facebook"></i></p>
                                    <h1><?php echo $row['car_name'] ?></h1> </div>
                                    <div class="form-group">
                                        <div class="col-sm-6">
                                            <button class="btn btn-success" style="background-color:#d22144; border-color:#d22144">Edit</button>
                                        </div>
                                        <div class="col-sm-6">
                                            <button class="btn btn-success" style="background-color:#2f323e; border-color:#2f323e">Delete</button>
                                        </div>
                                    </div>
                               
                            </div>
                        </div>
                    </div>
                <?php } ?>
                    
                </div>
               
            </div>
            <!-- /.container-fluid -->
            <footer class="footer text-center"> 2018 &copy; CarSecure</footer>
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
    <!-- jQuery -->
    <script src="JS/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="JS/bootstrap.min.js"></script>
    <!-- Menu Plugin JavaScript -->
    <script src="JS/sidebar-nav.min.js"></script>
    <!--slimscroll JavaScript -->
    <script src="JS/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="JS/waves.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="JS/custom.min.js"></script>
</body>

</html>
