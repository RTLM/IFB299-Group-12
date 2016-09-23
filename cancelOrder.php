<?php
session_start();
print_r($_SESSION["orderSQL"]);
unset($_SESSION["orderSQL"]);
print_r($_SESSION["orderSQL"]);
header("Location:order.php");
exit;
?>