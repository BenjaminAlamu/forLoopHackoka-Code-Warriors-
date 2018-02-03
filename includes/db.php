<?php ob_start(); ?>


<?php 

$db['db_host'] = "localhost";
$db['db_user'] = "root";
$db['db_pass'] = "blessyn22*";
$db['db_name'] = "cars";


foreach($db as $key => $value) {
    define(strtoupper($key), $value);
}


$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

/*if($connection) {

    echo "We are connected";

}*/










?>