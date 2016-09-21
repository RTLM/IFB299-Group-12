<?php
class database{
    private $conn;
    private $errorInConnection = false;
    /*This function will connect us to database for future updates to datbase.*/
    function connectToDatabase(){
        $servername = "localhost";
        $username = "root";
        $password = "root";
        $database = "ifb299";
        try{
            $this->conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
            // set the PDO error mode to exception
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            }
        catch(PDOException $e){
            echo "Connection failed: " . $e->getMessage();
            $this->errorInConnection = true;
            }
    }
    /*This function will update orders table*/
    function updateOrdersTable($accountNo,$destination,$pickup,$receiversName,$receiversContact,$status,$date){
        try{
            $sql = 
            "insert into orders(accountNo, destination, pickup, receiversName, receiversContact, status, orderDate) values('$accountNo','$destination','$pickup','$receiversName','$receiversContact','$status','$date');";
            // use exec() because no results are returned
            $this->conn->exec($sql);
            echo "New record created successfully";
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
    }
    /*This fucntion will update customers table*/
    function updateCustomersTable($emailId,$address,$contactNumber,$firstName,$lastName,$password){
        try{
                $sql = 
                "insert into customers value('$emailId','$address','$contactNumber','$firstName','$lastName','$password');";
                // use exec() because no results are returned
                $this->conn->exec($sql);
                echo "New record created successfully";
        }
        catch(PDOException $e){
                echo $e->getMessage();
        }
    }
    function checkIfUserExist($userName,$password){
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
    function getArrayOfValues($sqlSt){
        $executeCommand = $this->conn->prepare($sqlSt);
        $executeCommand->execute();
        $fetchData = $executeCommand->fetchAll();
        return $fetchData;
    }
    function checkInputsIfEmpty($input){
        if(strlen($input)==0){
            return true;
        }
        return false;
    }
}