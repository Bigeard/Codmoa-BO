<?php 
require_once 'ConnectionMethods.php';

$verif = new VerificationAPI();
$verif->checkLoginInfos($_POST["user_name"], $_POST["user_password"]);


?>