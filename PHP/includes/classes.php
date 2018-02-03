<?php include "db.php"; ?>
<?php include "functions.php"; ?>




<?php


if($_SERVER['REQUEST_METHOD'] == "POST") {

    $user_fullname = trim($_POST['user_fullname']);
    $user_email    = trim($_POST['user_email']);
    $user_password = trim($_POST['user_password']);
    $user_phone_no = trim($POST['user_phone_no']);

    $error = [

        'user_fullname'=> '',
        'user_email'=> '',
        'user_password'=> '',
        'user_phone_no'=> ''
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






?>






}

