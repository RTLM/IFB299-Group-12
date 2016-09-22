<?php
session_start();
echo $_SESSION["orderSQL"];
unset($_SESSION["orderSQL"]);