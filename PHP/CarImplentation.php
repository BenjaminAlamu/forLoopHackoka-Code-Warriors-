<?php

    require "PHP/Car.php";

    $car = new Car();

    if (isset($_POST['create'])){

        $memberData = array();
        $memberData = SESSION([user_id]);
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

        if(strlen($user_password) < 6) {


            $error['user_password'] = '<b class="text-danger">Password needs to be longer</b>';
        }


        if($user_fullname =='') {


            $error['user_fullname'] = '<b class="text-danger">Name cannot be empty</b>';
        }



        if($user_email =='') {


            $error['user_email'] = 'Email cannot be empty';
        }


        if(email_exists($email)) {


            $error['user_email'] = 'Email already exists, Please login</a>';
        }

        if($user_password == '') {


            $error['user_password'] = 'Password cannot be empty';
        }


        foreach ($error as $key => $value) {

            if (empty($value)){
    
                unset($error[$key]);  
            
            }

        }//for loop

        if(empty($error)){

            register_user($user_fullname, $user_email, $user_password, $user_phone_no);

            login_user($user_email, $user_password);
            
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