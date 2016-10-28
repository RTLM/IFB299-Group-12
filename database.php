<?php
/*This API is created to connect to database. It also consists other functions to validate
and sanitize the user input.
Note: The functions that are not my work are refrenced to their authors
@author: Navjot Singh Dhaliwal
*/
class database{
    private $conn;
    /*This function will connect us to database for future updates to datbase.*/
    function connectToDatabase(){
        $serverName = "sp6xl8zoyvbumaa2.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
        $username = "zb6tlk01gqtov2fy";
        $password = "cv6ok6emcaqd28uc";
        $database = "zqqzsvykt8d5j90x";
        try{
            $this->conn = new PDO("mysql:host=$serverName;dbname=$database", $username, $password);
            // set the PDO error mode to exception
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return true;

            }
        catch(PDOException $e){
            echo "Connection failed: " . $e->getMessage();
            return false;
            }
    }
    function runASqlQuery($sql){
        try{
            $this->conn->exec($sql);
            return true;
        } catch (Exception $ex) {
            return false;
        }
    }
    /*This function will update orders table*/
    function makeOrder($sql){
        try{
            $this->conn->exec($sql);
            return true;
        }
        catch(PDOException $e){
            return $e;
        }
    }
    /*This fucntion will update customers table
    @author: Josh
    */
    function makeAccount($emailId,$address,$contactNumber,$firstName,$lastName,$password,$accountType){
        if($this->checkIfEmailIdUsed($emailId)){
            return false;
        }
        try{
                $sql = 
                "INSERT INTO accounts(emailId, password, accountType) VALUES ('$emailId', '$password', '$accountType');
                INSERT INTO customers(accountNo, address, contactNo, firstName, lastName) VALUES (LAST_INSERT_ID(), '$address', '$contactNumber', '$firstName', '$lastName');
                ";
                $this->conn->exec($sql);
                return true;
        }
        catch(PDOException $e){
                header("Location:error.php");
        }
    }
    function checkCredentials($userName,$password){
        $user = $this->conn->prepare("select emailId, accountNo, accountType from accounts where emailId = '$userName' and password = '$password';");
        $user->execute();
        if($user->rowCount()==1){
            $account = $user->fetch(PDO::FETCH_ASSOC);
            return $account;
        }
        else{
            return false;
        }
    }
    function checkIfEmailIdUsed($email){
        $user = $this->conn->prepare("select emailId, accountNo, accountType from accounts where emailId = '$email';");
        $user->execute();
        if($user->rowCount()==1){
            return true;
        }
        else{
            return false;
        }
    }
    function getArrayOfValues($sqlSt){
        $executeCommand = $this->conn->prepare($sqlSt);
        $executeCommand->execute();
        $fetchData = $executeCommand->fetchAll(PDO::FETCH_ASSOC);
        return $fetchData;
    }
    function checkInputsIfEmpty($input){
        if(strlen($input)==0){
            return true;
        }
        return false;
    }
    function invalidate($string,$type){
        $patternPassword = '/[A-Za-z].*[0-9]|[0-9].*[A-Za-z]/';
        $patternNumber = "/^(0(2|3|4|7|8))?\d{8}$/";
        switch($type){
            case "password":{
                if(!preg_match($patternPassword, $string) && strlen($string)<8){
                    return true;
                }
                return false;
            }
            case "email":{
                if(!filter_var($string, FILTER_VALIDATE_EMAIL)){
                return true;
                }
                else{
                return false;
                }
            }
            case "name":{
                if(ctype_alpha($string)){
                    return false;
                }
                return true;
            }
            case "number":{
                if(preg_match($patternNumber,$string)){
                    return false;
                }
                return true;
            }
        }//end switch
    }//end function 
    /*
        This function will check if address is correct and return an array. Otherwise
        will return false. 
        Note: This code is not my work.
        @author: https://www.codeofaninja.com/2014/06/google-maps-geocoding-example-php.html
    */
    function geocode($address){
        // url encode the address
        $address = urlencode($address);
        // google map geocode api url
        $url = "http://maps.google.com/maps/api/geocode/json?address={$address}";
        // get the json response
        $resp_json = file_get_contents($url);
        // decode the json
        $resp = json_decode($resp_json, true);
        // response status will be 'OK', if able to geocode given address 
        if($resp['status']=='OK'){
            // get the important data
            $lati = $resp['results'][0]['geometry']['location']['lat'];
            $longi = $resp['results'][0]['geometry']['location']['lng'];
            $formatted_address = $resp['results'][0]['formatted_address'];
            // verify if data is complete
            if($lati && $longi && $formatted_address){
                // put the data in the array
                $data_arr = array();            
                array_push(
                    $data_arr, 
                        $lati, 
                        $longi, 
                        $formatted_address
                    );
                return $data_arr;
            }
            else{
                return false;
            }
        }
        else{
            return false;
        }
    }
    function checkIfAddressIsInBrisbane($address){
        $arrayOfAddress = $this->geocode($address);
        $radius = 25;
        $latitude;
        $longitude;
        $brisbaneLat = -27.468636;
        $brisbaneLon = 153.024424;
        if($arrayOfAddress == false){
            return false;
        }
        $latitude = $arrayOfAddress[0];
        $longitude = $arrayOfAddress[1];
        $distance = $this->haversineGreatCircleDistance($brisbaneLat,$brisbaneLon,$latitude,$longitude);
        return ($distance<$radius);
    }
        /**
     * Calculates the great-circle distance between two points, with
     * the Haversine formula.
     * @param float $latitudeFrom Latitude of start point in [deg decimal]
     * @param float $longitudeFrom Longitude of start point in [deg decimal]
     * @param float $latitudeTo Latitude of target point in [deg decimal]
     * @param float $longitudeTo Longitude of target point in [deg decimal]
     * @param float $earthRadius Mean earth radius in [m]
     * @return float Distance between points in [m] (same as earthRadius)
     */
    function haversineGreatCircleDistance(
      $latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo)
    {
        $earthRadius = 6371;
      // convert from degrees to radians
        $latFrom = deg2rad($latitudeFrom);
        $lonFrom = deg2rad($longitudeFrom);
        $latTo = deg2rad($latitudeTo);
        $lonTo = deg2rad($longitudeTo);

        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;

        $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
        cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
        return $angle * $earthRadius;
    }
}