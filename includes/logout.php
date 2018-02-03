<?php ob_start(); ?> 


<?php session_start(); ?>


<?php


$_SESSION['user_id'] = null;

session_destroy();

header("Location: ../login.php");


?>