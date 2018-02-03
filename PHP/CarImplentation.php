<?php

    require "PHP/Car.php";

    $car = new Car();

    if (isset($_POST['create'])){

        $memberData = array();
        $memberData = $_SESSION['user_id'];
		$memberData['car_name'] = test_input($_POST["car_name"]);
        $memberData['car_color'] = test_input($_POST["car_color"]);
        $memberData['car_chassis'] = test_input($_POST["car_chassis"]);
        $memberData['car_plate_no'] = test_input($_POST["car_plate_no"]);
        $memberData['car_status'] = test_input($_POST["car_status"]);

        //validating and saving image path
        

        $memberData['car_path'] = $path;

        $error = [
            'car_name'=> '',
            'car_color'=> '',
            'car_chassis'=> '',
            'car_plate_no'=> '',
            'car_status'=> '',
            'car_path'=> ''
        ];


        // This Part Checks for the length of the Password

        if($car_name == '') {

            $error['car_name'] = '<b class="text-danger">Car Name Cannot be empty</b>';
        }


        if($car_color == '') {

            $error['car_color'] = '<b class="text-danger">Car Color Cannot be empty</b>';
        }

        if($car_chassis == '') {

            $error['car_chassis'] = '<b class="text-danger">Car Chassis Number Cannot be empty</b>';
        }


        if($car_plate_no == '') {

            $error['car_plate_no'] = '<b class="text-danger">Car Plate Number Cannot be empty</b>';
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

            $resp = $car->create($memberData);

            if(is_string($resp)){
                $error['car_chassis'] = '<b class="text-danger">Invalid Chassis Number</b>';
                $error['car_plate_no'] = '<b class="text-danger">Invalid Plate Number</b>';
            }
            else if(is_bool($resp) && $resp == True) {

                header("location: dashboard.php");
            }
            else{
                header("location: register_car.php");
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