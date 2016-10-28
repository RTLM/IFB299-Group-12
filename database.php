<?php
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
    /*This fucntion will update customers table*/
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
}