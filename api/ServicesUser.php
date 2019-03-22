<?php
session_start();
require_once 'ConnectionMethods.php';

class ServicesUser extends ConnectionMethods {

    public function addUser($user_firstname, $user_lastname, $user_email, $user_password)
    {

        $this->startConnection('postgres', 'P@ssw0rd');

        //------------------------ Detect user exist --------------------------------

        $sql="SELECT user_firstname, user_lastname, user_email
        FROM schema.table_users 
        WHERE user_firstname = :user_firstname
        AND user_lastname = :user_lastname
        OR user_email = :user_email";
        $req = $this->connection->prepare($sql);
        $req->bindParam(':user_firstname', $user_firstname);
        $req->bindParam(':user_lastname', $user_lastname);
        $req->bindParam(':user_email', $user_email);
        $req->execute();
        $exist = $req->fetch();
        
        //------------------------ Create user --------------------------------

        if(!isset($exist['user_firstname']) || !isset($exist['user_lastname']) || !isset($exist['user_email'])) {
            $sql="INSERT INTO table_users
            (user_firstname, user_lastname, user_email, user_password)
            VALUES (:user_firstname, :user_lastname, :user_email, :user_password)";
            $req = $this->connection->prepare($sql);
            $req->bindParam(':user_firstname', $user_firstname);
            $req->bindParam(':user_lastname', $user_lastname);
            $req->bindParam(':user_email', $user_email);
            $req->bindParam(':user_password', md5($user_password));
            $req->execute();
            $result = true;
        } else {
            $result = false;
        }
        $this->endConnection();
        return $result;
    }
}

//------------------------ Verify Post --------------------------------

if(isset($_POST['signup']) &&
    isset($_POST['user_firstname']) &&
    isset($_POST['user_lastname']) &&
    isset($_POST['user_email']) &&
    isset($_POST['user_password']) &&
    $_SERVER['REQUEST_METHOD'] === 'POST') {

        $service = new ServicesUser;
        $result = $service->addUser($_POST['user_firstname'], $_POST['user_lastname'], $_POST['user_email'], $_POST['user_password']);

        if($result) {
            header('Location: ../index.php?info=3');
        } else {
            header('Location: ../signup.php?info=1');
        }

} else {
    header('Location: ../signup.php?info=2');
}