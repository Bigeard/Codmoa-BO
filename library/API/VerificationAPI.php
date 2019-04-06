<?php
require_once 'ConnectionAPI.php';
require_once 'DatabaseAPI.php';

class VerificationAPI extends ConnectionAPI
{
    public function checkLoginInfos($username, $password)
    {

        $host = '127.0.0.1';
        $port = 5432;
        $dbname = 'codmoa';

        $verify = new DatabaseAPI();

        try {
            //Check if user has the CONNECT permission on database
            if ($verify->checkConnectionRight($_POST["username"])) {
                session_start();
                //Check if credentials are OK
                $connection = pg_connect("host=$host port=$port dbname=$dbname user=$username password=$password");
                if ($connection) {
                    $_SESSION["username"] = $_POST["username"];
                    $_SESSION["password"] = $_POST["password"];

                    //Redirect SUCCESS
                    header('Location: ../pages/requests.php');
                    exit;
                } else {
                    //Redirect INCORRECT LOGIN
                    header('Location: ../index.php?error=1');
                    exit;
                }
            } else {
                //Redirect WRONG CREDENTIALS
                header('Location: ../index.php?error=3');
                exit;
            }
        }
        catch (Exception $e) {
            //Redirect INCORRECT LOGIN (User not found)
            header('Location: ../index.php?error=1');
            exit;
        }
    }
}
