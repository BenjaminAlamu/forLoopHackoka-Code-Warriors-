

<?php

    ob_start();
    include "includes/db.php";
    include "includes/functions.php";
    require "PHP/Car.php";
    session_start();

?>

<?php 
    //var_dump($_SESSION['user_id']);
    //die();
    session_start();

    if(!isset($_SESSION['user_id'])){

        header("Location: login.php");
    }
    else{

    

    $_SESSION['user_id2'] = $_SESSION['user_id'];
    
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
    <link rel="icon" type="image/png" sizes="16x16" href="IMG/CarSecureLogo.png">
    <title>Car Authentication</title>
    <!-- Bootstrap Core CSS -->
    <link href="CSS/bootstrap.min.css" rel="stylesheet">
    <!-- Menu CSS -->
    <link href="CSS/sidebar-nav.min.css" rel="stylesheet">
    <!-- morris CSS -->
    <link href="CSS/morris.css" rel="stylesheet">
    <!-- chartist CSS -->
    <link href="CSS/chartist.min.css" rel="stylesheet">
    <link href="CSS/chartist-plugin-tooltip.css" rel="stylesheet">
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
                    <a class="logo" href="Dashboard.html">
                            <img src="IMG/CarSecureLogo.png" alt="home" class="dark-logo" /><!--This is light logo text--><img src="IMG/CarSecureLogo.png" alt="home" class="light-logo" />
                         </span> </a>
                </div>
                <!-- /Logo -->



                
                <ul class="nav navbar-top-links navbar-right pull-right">
                    <li>
                        <a class="Dashboard-profile-pic" href="#" value=""><b class="hidden-xs profile-name">
                            
                            
                            
                        <?php

                        if(isset($_SESSION['user_id'])) {

                        echo $_SESSION['user_fullname'];
                    }
                  
                        
                        ?>
                    
                  
                            </b></a>
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
                        <a href="Dashboard.html" class="waves-effect"><i class="fa fa-clock-o fa-fw" aria-hidden="true"></i>Dashboard</a>
                    </li>
                    <li>
                        <a href="#" class="waves-effect"><i class="fa fa-user fa-fw" aria-hidden="true"></i>Profile</a>
                    </li>
                    <li>
                        <a href="Dashbord-regcar.html" class="waves-effect"><i class="fa fa-table fa-fw" aria-hidden="true"></i>Register Car</a>
                    </li>
                    <li>
                        <a href="Dashboard_Viewcar.html" class="waves-effect"><i class="fa fa-binoculars fa-fw" aria-hidden="true"></i>View Cars</a>
                    </li>
                    <li>
                        <a href="Dashboard_edit.html" class="waves-effect"><i class="fa fa-pencil fa-fw" aria-hidden="true"></i>Edit Car Status</a>
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
                        <h4 class="page-title">Dashboard</h4> </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <ol class="breadcrumb">
                            <li><a href="#">Dashboard</a></li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                
                
                <div class="row" align="center">
                   <img src="IMG/happy.svg" width="200px" height="200px" style="margin-top:150px;">
                   <p style="margin-top:20px;">Lets Get Started By <a href="Dashbord-regcar.html" style="cursor:pointer;">Registering</a> your car</p>
                </div>
            </div>
            <!-- /.container-fluid -->
            <footer class="footer text-center"> 2018 &copy; CarSecure</footer>
        </div>
        <!-- ============================================================== -->
        <!-- End Page Content -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="JS/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="JS/bootstrap.min.js"></script>
    <!-- Menu Plugin JavaScript -->
    <script src="JS/sidebar-nav.min.js"></script>
    <!--slimscroll JavaScript -->
    <script src="js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="JS/waves.js"></script>
    <!--Counter js -->
    <script src="JS/jquery.waypoints.js"></script>
    <script src="JS/jquery.counterup.min.js"></script>
    <!-- chartist chart -->
    <script src="JS/chartist.min.js"></script>
    <script src="JS/chartist-plugin-tooltip.min.js"></script>
    <!-- Sparkline chart JavaScript -->
    <script src="JS/jquery.sparkline.min.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="JS/custom.min.js"></script>
    
    <script src="JS/jquery.toast.js"></script>
</body>

</html>
