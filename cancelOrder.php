<?php
session_start();
unset($_SESSION["orderSQL"]);
header("Location:order.php");
exit;
?>
