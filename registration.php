
<?php

    include "includes/db.php";
    include "includes/functions.php";
    include "includes/sessions.php";

?>



<html>

<head>
    <title>Login</title>
    <link rel="stylesheet" href="css/login.css">
    <link href="css/bootstrapi.min.css" rel="stylesheet">
</head>


<?php








if($_SERVER['REQUEST_METHOD'] == "POST") {

    $user_fullname = trim($_POST['user_fullname']);
    $user_email    = trim($_POST['user_email']);
    $user_password = trim($_POST['user_password']);
    $user_phone_no = trim($_POST['user_phone_no']);


    


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


    if(email_exists($user_email)) {


        $error['user_email'] = '<a class="text-danger">Email already exists, Please login</a>';
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

<?php
if(isset($_POST['register'])) {


    
    header("Location: dashboard.php");

} 

    

 ?>




<body>
    <header>
        <nav>
            <ul>
                <li id="logo">
                    <a href="index.html"></a><img src="img/CarSecureLogo.png"></li>
                <li>
                    <a href="index.html">Home</a></li>

                <li>
                    <a href="login.php">Login</a></li>
                <li>
                    <a href="aboutus.html">About Us</a></li>
            </ul>

        </nav>
    </header>

    <div id="register_form" action="registration.php">
        <h2 id="title"> Register</h2>
        <form method="POST">
            <div class="form-group">
                <input class="form-control" type="text" id="fullname" name="user_fullname" placeholder="Fullname" value="<?php echo isset($user_fullname) ? $user_fullname : '' ?>" required><br>
            </div>
            <div class="form-group">
                <input type="email" id="email_address" class="form-control" name="user_email" placeholder="Email" value="<?php echo isset($user_email) ? $user_email : '' ?>" required>
                <p><?php echo isset($error['user_email']) ? $error['user_email'] : '' ?></p>
            </div>
            <div class="form-group">
                <input type="number" class="form-control" id="phone_number" name="user_phone_no" placeholder="Phone Number" value="<?php echo isset($user_phone_no) ? $user_phone_no : '' ?>" required>
                
            </div>
            <div class="form-group">
                <input type="password" class="form-control" id="password" name="user_password" placeholder="Password" value="<?php echo isset($user_password) ? $user_password: '' ?>" required>
                <p><?php echo isset($error['user_password']) ? $error['user_password'] : '' ?></p>
            </div>
            
            <input type="submit" class="btn btn-lg btn-success btn-block" name="register" id="" value="Register">
        </form>
    </div>

</body>







<script src="js/jquery.js"></script>

<script src="js/bootstrap.min.js"></script>
</html>