<?php
    require_once 'ConnectionAPI.php';

    class VerificationAPI extends ConnectionAPI{
        public function checkLoginInfos($username, $password){

            $host = '<host>';
            $port = 5432;
            $dbname = '<dbname>';

            $connection = pg_connect("host=$host port=$port dbname=$dbname user=$username password=$password");
            if($connection) {
                session_start();
                $_SESSION["username"] = $_POST["username"];
                $_SESSION["password"] = $_POST["password"];
                header('Location: ../pages/requests.php');
            } else {
                header('Location: ../index.php?error=1');
            } 
        }
    }
?>