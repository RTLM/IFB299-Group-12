<?php
$url = getenv(mysql://zb6tlk01gqtov2fy:cv6ok6emcaqd28uc@sp6xl8zoyvbumaa2.cbetxkdyhwsb.us-east-1.rds.amazonaws.com:3306/zqqzsvykt8d5j90x);
$dbparts = parse_url($url);

$hostname = $dbparts['host'];
$username = $dbparts['user'];
$password = $dbparts['pass'];
$database = ltrim($dbparts['path'],'/');
try {
    $conn = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	 
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
?>