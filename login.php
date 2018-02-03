






<?php ob_start(); ?>
<?php session_start(); 
    $_SESSION['user_id'] = "";
?>

<?php include "includes/functions.php"; ?>

<?php include "includes/db.php"; ?>

<?php require "PHP/Car.php"; ?>




<?php
if(isset($_POST['login'])) {;

    $car = new Car();

    login_user($_POST['user_email'],$_POST['user_password'] );

    $rows = $car->get_user_id($_POST['user_email']);
    foreach($rows as $row){
        $_SESSION['user_id'] = $row['user_id'];
    }
    
    header("Location: dashboard.php");

} 

    

 ?>











<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <link rel="stylesheet" href="css/login.css">
    <link href="css/bootstrapi.min.css" rel="stylesheet">
</head>

<body>
    <header>
        <nav>
            <ul>
                <li id="logo">
                    <a href="index.html"></a><img src="img/CarSecureLogo.png" alt="logo"></li>
                <li>
                    <a href="index.html">Home</a></li>

                <li>
                    <a href="register.html">Register</a></li>
                <li>
                    <a href="aboutus.html">About Us</a></li>
            </ul>

        </nav>
    </header>

    <div id="form" method="post" action=login.php>
        <h2 id="title">Login</h2>
        <form method="post">
            <div class="fprm-group">
                <input type="email" class="form-control" id="email_address" name="user_email" placeholder="Email"><br>
            </div>
            <div class="form-group">
                <input type="password" id="password" class="form-control" name="user_password" placeholder="Password"><br>
            </div>
            <input type="submit" name="login" class="btn btn-lg btn-success btn-block" id="" value="Submit">
        </form>
    </div>

</body>


<script src="js/jquery.js"></script>

<script src="js/bootstrap.min.js"></script>


</html>