<?php
/**
 * This test unit is created to test database class functions.
 * For this test suite to work you need phpUnit version 4.8.27 and 
 * PHP version 5.3.28. If you use any other versions for PHP or 
 * phpUnit serious errors may occur.
 * @author:Navjot Singh Dhaliwal
 */
class test extends PHPunit_Framework_Testcase {
    /*
     * Testing the database connection.
     * Database variable will return true 
     * if connection is made false otherwise.
     * Expected=true;
     */
    public function testDatabaseConnection(){
        include('c:\PHP\database.php');
        $db = new database;
        $connectionToDatabase = $db->connectToDatabase();
        $this->assertEquals(true,$connectionToDatabase);
    }
    /**
     * Run a sql query on database and check if it succeeds.
     * It will return true on success false otherwise.
     * expected = false;
     */
    public function testRunASqlQuery(){
        $sql = "Select * from orders;";
        $db = new database;
        $db->connectToDatabase();
        $success = $db->runASqlQuery($sql);
        $this->assertEquals(true,$success);
    }
    /**
     * We are going to test runASqlQuery again
     * but this time will expect it to fail.
     */
    public function testRunASqlQuery2(){
        $sql = "Select * from 123;";//No table named 123
        $db = new database;
        $db->connectToDatabase();
        $success = $db->runASqlQuery($sql);
        $this->assertEquals(false,$success);
    } 
    /**
     * This function will check if we can make order and it
     * is listed in database.
     */
    public function testMakeOrderAndGetArrayOfValue(){
        $sqlToDeleteOrder = "delete from orders where orderNo=1000";
        $sql = "INSERT INTO `zqqzsvykt8d5j90x`.`orders` (`orderNo`, `accountNo`, `destination`, `pickUp`, `receiversName`, `receiversContact`, `status`) VALUES ('1000', '2', 'n', 'n', 'n', 'n', 'n');";
        $db = new database;
        $db->connectToDatabase();
        $deleted = $db->runASqlQuery($sqlToDeleteOrder);
        if($deleted){
            $success = $db->makeOrder($sql);
            $this->assertEquals(true,$success);
            $sql = "select * from orders where orderNo=1000";
            $orderResult = $db->getArrayOfValues($sql);
            $this->assertEquals(1,count($orderResult));
        }
    }
    /**
     * This function is going to test emailId Used function and 
     * we will use owner@gmail.com account which is already listed
     *  in databse.
     */
    public function testCheckIfEmailIdUsed(){
        $db = new database;
        $db->connectToDatabase();
        $this->assertEquals(true,$db->checkIfEmailIdUsed("owner@gmail.com"));
    }
    /**
     * This test is going to test if we have record for
     * given email and password
     */
    public function testCheckCredentials(){
        $db = new database;
        $db->connectToDatabase();
        $result = $db->checkCredentials("owner@gmail.com","owner");
        $this->assertEquals("owner@gmail.com",$result["emailId"]);
    }
    /**
     * This test is going to test string == null checker 
     * function
     */
    public function testCheckInputsIfEmpty(){
        $db = new database;
        $this->assertTrue($db->checkInputsIfEmpty(""));
    }
}
