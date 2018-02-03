
<?php

function register_user($user_fullname, $user_email, $user_password, $user_phone_no) {


    global $connection;


        

        $user_fullname = mysqli_real_escape_string($connection, $user_fullname);
        $user_email    = mysqli_real_escape_string($connection, $user_email);
        $user_password = mysqli_real_escape_string($connection,  $user_password);
        $user_phone_no = mysqli_real_escape_string($connection,  $user_phone_no);



        $query = "INSERT INTO users(user_fullname, user_email, user_password, user_phone_no)";
        $query .= "VALUES('{$user_fullname}','{$user_email}','{$user_password}','$user_phone_no' )";
        $register_user_query = mysqli_query($connection, $query);

       confirmQuery($register_user_query);

         $message = "Your Registration has been submitted";

        

}

















function confirmQuery($result) {

    global $connection;
     if(!$result ) {

            die("QUERY FAILED ." . mysqli_error($connection));
        }

        
}


function email_exists($user_email){

    global $connection;


    $query = "SELECT user_email FROM users WHERE user_email = '$user_email'";
    $result = mysqli_query($connection, $query);
    confirmQuery($result);

    if(mysqli_num_rows($result) > 0) {

        return true;

    } else {

        return false; 
    }

}






function login_user($user_email, $user_password){
    
    global $connection;

// Immediate code below to to check and clean any mysql injection 


$user_email = trim($user_email);
$user_password = trim($user_password);

$user_email = mysqli_real_escape_string($connection, $user_email );
$user_password = mysqli_real_escape_string($connection, $user_password );

$query = "SELECT * FROM users WHERE user_email = '{$user_email}' ";
$select_user_query = mysqli_query($connection, $query);

if(!$select_user_query) {

    die("QUERY FAILED". mysqli_error($connection));

}

    while($row = mysqli_fetch_array($select_user_query)){


        $db_user_id = $row['user_id'];
        $db_user_fullname = $row['user_fullname'];
        $db_user_email = $row['user_email'];
        $db_user_password = $row['user_password'];
        $db_user_phone_no = $row['user_phone_no'];
        
    }



if (password_verify($user_email,$db_user_password) ){

    $_SESSION['user_email'] = $db_user_email;
    $_SESSION['user_fullname'] = $db_user_fullname;
    $_SESSION['user_phone_no'] = $db_user_phone_no;
    
        redirect(".php");
    }

}

    
?>