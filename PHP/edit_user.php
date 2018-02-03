
<?php if(isset($_GET['edit_user'])) {

    $the_user_id = $_GET['edit_user'];


     $query = "SELECT * FROM users WHERE user_id = $the_user_id ";
            $select_users_query = mysqli_query($connection, $query);

            while($row = mysqli_fetch_assoc($select_users_query)) {
            $user_id = $row['user_id'];
            $user_fullname = $row['user_fullname'];
            $user_password = $row['user_password'];
            $user_phone_no = $row['user_phone_no'];
            
            }


    if(isset($_POST['edit_user'])) {

        $user_fullname = $_POST['user_fullname'];
        
        if(!empty($user_password)){

            $query_password = "SELECT user_password FROM users WHERE user_id = $the_user_id";
            $get_user_query = mysqli_query($connection, $query_password);
            confirmQuery($get_user_query);

            $row = mysqli_fetch_array($get_user_query);

            $db_user_password = $row['user_password'];



             if($db_user_password != $user_password) {

            $hashed_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 12));

            }  

        $user_phone_no = $_POST['user_phone_no'];

         
        $query = "UPDATE users SET ";
       $query .="user_fullname = '{$user_fullname}', ";
       $query .="user_email = '{$user_email}', ";
       $query .="user_password   = '{$hashed_password}' ";
       $query .="user_phone_no = '{$user_phone_no}', ";
       $query .= "WHERE user_id = {$the_user_id} ";

        $edit_user_query = mysqli_query($connection,$query);

        confirmQuery($edit_user_query);  


    echo "User Updated" .  "<a href='users.php'> View Users?</a>";

         }



       

    }

    } else {

        header("Location:.php");
    }


?>



