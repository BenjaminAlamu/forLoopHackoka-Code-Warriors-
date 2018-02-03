<?php
    session_start();

     require "PHP/Car.php";
    $car = new Car();

    $rows = $car->get_car($_SESSION['car_id']);
    

?>

<!DOCTYPE html>
<html>

<head>
    <title>CarSecure Results</title>
    <link rel="stylesheet" href="css/login.css">
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
                    <a href="login.html">Login</a></li>
                <li>
                    <a href="aboutus.html">About Us</a></li>
            </ul>

        </nav>
    </header>

    <div id="resultContent">
        <?php if($rows == null){ ?>
        <div id="noCarFound">
            <h3 id="error">Car not found in database</h3>
        </div>
        <?php } else{ foreach($rows as $row){ ?>

        <div id="carFound"> 
            <p>Congratutions, Car was found. Here are the details</p>
            <?php echo $row['car_image'] ?>
            <p>Car Brand: <?php echo $row['car_brand'] ?></p>
            <p>Plate Number : <?php echo $row['car_plate_no'] ?></p>
            <p>Chassis Number: <?php echo $row['car_chassis'] ?></p>
            <p>Car Status: <?php echo $row['car_status'] ?></p>

        </div>
        <?php } } ?>
    </div>


</body>

</html>