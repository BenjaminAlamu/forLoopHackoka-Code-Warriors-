`<?php
    session_start();
    //var_dump($_SESSION['user_id2']);
    //die();

    if(!isset($_SESSION['user_id2'])){

        header("Location: login.php");
    }

    require "PHP/Car.php";

    $car = new Car();

    if (isset($_POST['create'])){


        $memberData = array();
        $memberData['id'] = $_SESSION['user_id2'];
		$memberData['car_name'] = test_input($_POST["car_name"]);
        $memberData['car_brand'] = test_input($_POST["car_brand"]);
        $memberData['car_chassis'] = test_input($_POST["car_chassis"]);
        $memberData['car_plate_no'] = test_input($_POST["car_plate_no"]);
        $memberData['car_status'] = test_input($_POST["car_status"]);

        //validating and saving image path
        

        

            $rand = rand(1, 100000);

            $upload_dir = "uploads/";
			$upload_file = $upload_dir  ."/". basename($_FILES["car_image"]["name"]);
			$img_type = strtolower(pathinfo($upload_file, PATHINFO_EXTENSION));
			$newName = $upload_dir ."/". $rand."." . $img_type;
            $uploadOk = 1;
            $memberData['car_path'] = $_FILES["car_image"]["name"];

			try{
				//$checkImg = getimagesize($_FILES["car_image"]["tmp_name"]);
			}
			catch(PDOException $e) {
				//echo "invalid image". $e -> getMessage();
            }
            
    


        $error = [
            'car_name'=> '',
            'car_brand'=> '',
            'car_chassis'=> '',
            'car_plate_no'=> '',
            'car_status'=> '',
            'car_image'=> ''
        ];


        if($memberData['car_name'] == '') {

            $error['car_name'] = '<b class="text-danger">Car Name Cannot be empty</b>';
        }


        else if($memberData['car_brand'] == '') {

            $error['car_brand'] = '<b class="text-danger">Car Brand Cannot be empty</b>';
        }

        else if($memberData['car_chassis'] == '') {

            $error['car_chassis'] = '<b class="text-danger">Car Chassis Number Cannot be empty</b>';
        }


        else if($memberData['car_plate_no'] == '') {

            $error['car_plate_no'] = '<b class="text-danger">Car Plate Number Cannot be empty</b>';
        }

        else if($memberData['car_status'] == '') {

            $error['car_status'] = '<b class="text-danger">Car status Cannot be empty</b>';
        }
        
       /* else if($checkImg == false) {
				$error['car_image'] = "Please upload an actual image";
				$uploadOk = 0;
			}*/
			
			else if($_FILES["car_image"]["size"] > 500000) {
				$error['car_image'] = "File size must be less than 500kb";
				$uploadOk = 0;
			}

			else if(($img_type != "jpg") && ($img_type != "png") && ($img_type != "jpeg") && ($img_type != "gif")) {
				$error['car_image'] = "Only jpg, jpeg and png files are allowed";
				$uploadOk = 0;
			}

        else{

            if($uploadOk == 1){
                 
               // if(move_uploaded_file($_FILES["car_name"]["tmp_name"], $upload_file)) {
            
				//    if( rename($upload_file, $newName)){
                    
						   
                        $resp = $car->create($memberData);

    
                        if(is_string($resp)){
                            $error['car_chassis'] = '<b class="text-danger">Invalid Chassis Number</b>';
                            $error['car_plate_no'] = '<b class="text-danger">Invalid Plate Number</b>';
                        }
                        else if(is_bool($resp) && $resp == True) {

                            header("location: Dashboard.php");
                        }
                        else{
                            
                           header("refresh:0");
                        }
                /*    }
                    else {
                        $error['car_image'] = "sorry an error occured in uploading your file ";
                    }
                }
                else {
                        $error['car_image'] = "sorry an error occured in uploading your file ";
                    }*/
            }	
            
        }


    }

    if (isset($_POST['update'])){

        $user_id = $_SESSION['user_id'];
        $car_status = test_input($_POST["car_status"]);
        $car_color = test_input($_POST["car_color"]);

        $error = [
            'car_status'=> '',
            'car_color'=> ''
        ];

        if($car_color == '') {

            $error['car_color'] = '<b class="text-danger">Car Color Cannot be empty</b>';
        }
        if($car_status == '') {

            $error['car_status'] = '<b class="text-danger">Car status Cannot be empty</b>';
        }


        foreach ($error as $key => $value) {

            if (empty($value)){
    
                unset($error[$key]);  
            
            }

        }//for loop

        if(empty($error)){

            $resp = $car->update($user_id, $car_status, $car_color);

            if(is_bool($resp) && $resp == True) {

                header("location: dashboard.php");
            }
            else{
                header("location: register_car.php");
            }		
            
        }

    }


    if (isset($_POST['delete'])){

        $resp = $car->delete($user_id);

        if(is_bool($resp) && $resp == True) {

            header("location: dashboard.php");
        }
        else{
            header("location: register_car.php");
        }		
    }

    function test_input($data) {

		if(empty($data)){
			global $error;
			$error = "Field is required";
		}

		else{

		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		}
		
		return $data;
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
                        <a class="Dashboard-profile-pic" href="#"> <b class="hidden-xs profile-name">Mayorwa Daniel</b></a>
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
                        <h4 class="page-title">Register Car</h4> </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <ol class="breadcrumb">
                            <li><a href="#">Dashboard</a></li>
                            <li class="active">Register Car</li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <div class="row">
                        <div class="col-md-12 col-xs-12">
                                <div class="white-box">
                                    <form id = "car_register"
                                    action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" 
                                    method = "post"
                                    enctype="multipart/form-data" 
                                    class="form-horizontal form-material">
                                            <div class="form-group">
                                                    <label class="col-md-12">Car Image</label>
                                                    <div class="col-md-12">
                                                        <input type="file" name="car_image"> </div>
                                                        <p><?php echo isset($error['car_image']) ? $error['car_image'] : '' ?></p>
                                                </div>
                                        <div class="form-group">
                                            <label class="col-md-12">Car Name</label>
                                            <div class="col-md-12">
                                                <input type="text" placeholder="Toyota" name="car_name" class="form-control form-control-line" value="<?php echo isset($_POST['car_name']) ? $_POST['car_name'] : ''; ?>"> </div>
                                                <p><?php echo isset($error['car_name']) ? $error['car_name'] : '' ?></p>
                                            </div>
                                        <div class="form-group">
                                            <label class="col-md-12">Car Brand</label>
                                            <div class="col-md-12">
<<<<<<< HEAD:Dashbord-regcar.php
                                                <input type="text" placeholder="Camry" name="car_brand" class="form-control form-control-line" value="<?php echo isset($_POST['car_brand']) ? $_POST['car_brand'] : ''; ?>"> 
                                            </div>
                                                <p><?php echo isset($error['car_brand']) ? $error['car_brand'] : '' ?></p>
=======
                                                <input type="text" placeholder="Audi A6" class="form-control form-control-line" name="car_brand"> </div>
>>>>>>> e3b50898709b2a720f0e524383e386f1cdd8a9c9:Dashboard-regcar.php
                                        </div>
                                        <div class="form-group">
                                                <label class="col-md-12">Plate Number</label>
                                                <div class="col-md-12">
                                                    <input type="text" placeholder="WRT-123-DDJ" name="car_plate_no" class="form-control form-control-line" value="<?php echo isset($_POST['car_plate_no']) ? $_POST['car_plate_no'] : ''; ?>"> </div>
                                                    <p><?php echo isset($error['car_plate_no']) ? $error['car_plate_no'] : '' ?></p>
                                                </div>
                                        <div class="form-group">
                                            <label class="col-md-12">Chasis Number</label>
                                            <div class="col-md-12">
                                                <input type="text" placeholder="123456789" name="car_chassis" value="<?php echo isset($_POST['car_chassis']) ? $_POST['car_chassis'] : ''; ?>" class="form-control form-control-line"> </div>
                                            <p><?php echo isset($error['car_chassis']) ? $error['car_chassis'] : '' ?></p>
                                            </div>
                    
                                        <div class="form-group">
                                                <label class="col-md-12">Car Status</label>
                                                <div class="col-md-12">
                                                        <label class="col-md-12">In Use</label>
                                                    <input type="radio" name="car_status" value="In use" class=""> 
                                                </div>
                                                <div class="col-md-12">
                                                        <label class="col-md-12">Availabe for Sale</label>
                                                    <input type="radio" name="car_status" value="Available For Sale" class=""> 
                                                </div>
                                                <div class="col-md-12">
                                                        <label class="col-md-12">Stolen</label>
                                                    <input type="radio" name="car_status" value="Stolen" class=""> 
                                                </div>
                                            </div>
                                       
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <input type="submit" name="create" value="create" class="btn btn-success">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                </div>
                <!-- /row -->
                
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
    <script src="CSS/sidebar-nav.min.js"></script>
    <!--slimscroll JavaScript -->
    <script src="JS/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="JS/waves.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="JS/custom.min.js"></script>
</body>

</html>
