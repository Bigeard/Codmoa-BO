<?php
session_start();
require_once 'ConnectionMethods.php';

class ServicesUser extends ConnectionMethods {

    public function getUserByList()
    {
        $this->startConnection();

        $sql = "SELECT * FROM table_users ORDER BY user_id DESC";
        $req = $this->connection->prepare($sql);
        $req->execute();

        $result = $req->fetchAll(PDO::FETCH_ASSOC);
        $this->endConnection();

        $result = count($result) > 0 ? $result : null; 

        return $result;
    }

    public function getUserById($id)
    {
        $this->startConnection();
        $sql = 'SELECT * FROM table_users WHERE user_id = :id ';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->endConnection();

        $result = count($result) > 0 ? $result : null; 

        return $result;
    }

    public function addUser($user, $password, $privileges, $tables)
    {

        $this->startConnection('postgres', 'P@ssw0rd');

        //------------------------ Detect user exist --------------------------------

        $sql="CREATE USER :user WITH ENCRYPTED PASSWORD ':password';
              GRANT :privileges ON :tables to :user;";
        $req = $this->connection->prepare($sql);
        $req->bindParam(':user', $user);
        $req->bindParam(':password', $password);
        $req->bindParam(':privileges', $privileges);
        $req->bindParam(':tables', $tables);
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