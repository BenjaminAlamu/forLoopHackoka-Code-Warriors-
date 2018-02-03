<?php
    require 'Database.php';

    require 'vendor/autoload.php';

    //include('../vendor/unicodeveloper/Mvrd/Mvrd');

    use Unicodeveloper\Mvrd\Mvrd;

    class Car{

        

        private $database;

        public function __construct(){
            $host = 'localhost';
            $db = 'cars';
            $username = 'root';
            $password = 'blessyn22*';

            $this->database = new Database($host, $db, $username, $password);
        }

        function create($data){
            $data_returned = $this->validate($data);

            if(is_array($data_returned)){

                try{
                    $this->database->query('INSERT INTO car_details (car_id, owner_id, car_name, car_brand, car_chassis, car_plate_no, car_image, car_status)VALUES (null, :owner_id, :carName, :color, :chasis, :plate_no, :imagePath, :status)');

                    $this->database->bind(':owner_id', $data['id']);
                    $this->database->bind(':carName', $data['brand']);
                    $this->database->bind(':color',$data['car_brand']);
                    $this->database->bind(':chasis',$data['car_chassis']);
                    $this->database->bind(':plate_no',$data['car_plate_no']);
                    $this->database->bind(':imagePath',$data['car_path']);
                    $this->database->bind(':status',$data['car_status']);

                    if($this->database->execute()){
                        return true;
                    }
                    else{
                        return false;
                    }
                }catch(PDOException $e){
                    
                    //echo 'Error Occured. '.$e->getMessage();
                }
            }
            else{
                return $data_returned;
            }
        }


        function validate($data){

            $plateNumber = $data['car_plate_no'];

            $mvrd = new Mvrd($plateNumber);

            if($mvrd->getData() != null){
                if(/*($mvrd->getData()['ChasisNumber'] == $data['car_chassis']) &&*/ ($mvrd->getData()['PlateNumber'] == $data['car_plate_no'])){
                    return $data;
                }
                else{
                    return 'pin not found';
                }
            }
            else{
                return 'pin not found';
            }
        }

        function read($car_chassis){
            $this->database->query('SELECT * FROM car_details WHERE car_chassis = :chassis');
            $this->database->bind(':chassis', $car_chassis);
            $rows = $this->database->resultset();
            
            //var_dump($rows);
            return $rows;
        }

        function update($user_id, $car_id, $car_status, $car_color){
            try{
                $this->database->query("UPDATE car_details SET car_status = '$car_status', car_color = '$car_color' WHERE owner_id = $user_id");
                
                if($this->database->execute()){
                    return true;
                }
                else{
                    return false;
                }
            }catch(PDOException $e){
                    
                    //echo 'Error Occured. '.$e->getMessage();
            }
        }

        function delete($user_id, $car_id){
            try{
                $this->database->query("DELETE FROM car_details WHERE id = :id");

                $this->database->bind(':id',$user_id);

                    if($this->database->execute()){
                        return true;
                    }
                    else{
                        return false;
                    }
            }catch(PDOException $e){
                    
                    //echo 'Error Occured. '.$e->getMessage();
            }

        }
    }

?>