<?php
    require_once 'ConnectionMethods.php';

    class VerificationAPI extends ConnectionMethods{
        public function checkLoginInfos($username, $password){

            $host = '127.0.0.1';
            $port = 5432;
            $dbname = 'codmoa';

            $connection = pg_connect("host=$host port=$port dbname=$dbname user=$username password=$password");
            if($connection) {
                session_start();
                $_SESSION["username"] = $_POST["user_name"];
                $_SESSION["password"] = $_POST["user_password"];
                header('Location: ../home.php');
            } else {
                header('Location: ../index.php?info=1');
            } 
        }
    }
?>