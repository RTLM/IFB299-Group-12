<?php
/**
 * This class has been implemented for testing of IFB299:SEM-2 project. Methods from 
 * this class will be used to test the methodd of other classes.
 */
class Assert{
    private $true;
    private $false;
    private $servername = "localhost";
    private $username = "root";
    private $password = "root";
    private $database = "ifb299";
    function equal($stringOne,$stringTwo){
        if($stringOne == $stringTwo){
            $this->true++;
            return true;
        }
        else{
            $this->false++;
            return false;
        }
    }//end function equal
    function isTrue($argu){
        if($argu){
            $this->true++;
            return true;
        }
        else{
            $this->false++;
            return false;
        }
    }
    function isFalse($argu){
        if($argu){
            $this->false++;
            return true;
        }
        else{
            $this->true++;
            return false;
        }
    }
}

