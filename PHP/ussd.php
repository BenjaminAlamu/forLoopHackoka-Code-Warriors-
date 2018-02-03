<?php

require "Car.php";

 $car = new Car();

// Reads the variables sent via POST from our gateway
$sessionId   = $_POST["sessionId"];
$serviceCode = $_POST["serviceCode"];
$phoneNumber = $_POST["phoneNumber"];
$text        = $_POST["text"];

$response = "";

if ( $text == "" ) {
     // This is the first request. Note how we start the response with CON
     $response  = "CON Enter the chassis number of the car: \n";
}
else if ( $text != "" ) {
  // Business logic for first level response

    //$response = "END ";

    $car_chassis = $text;

    $car_response = $car->read($car_chassis);

    if($car_response != null){
        foreach($car_response as $resp){
            $response .= "END ". $resp['car_status'];
        }
    }
    else{
        $response .= "END No car found";
    }
  
 }

header('Content-type: text/plain');
echo $response;
// DONE!!!
?>