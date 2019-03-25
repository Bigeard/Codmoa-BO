<?php 
require_once 'API/VerificationAPI.php';

$verif = new VerificationAPI();
$verif->checkLoginInfos($_POST["username"], $_POST["password"]);


?>