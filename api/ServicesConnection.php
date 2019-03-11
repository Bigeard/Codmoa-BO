<?php
require_once 'ConnectionMethods.php'; 

class Verify extends ConnectionMethods {

    public function connectionUser($user_email, $user_password) {
        $this->startConnection();

        $req = $this->connection->prepare('SELECT *
        FROM table_users
        WHERE user_email = :user_email
        AND user_password = :user_password');

        $req->bindParam(':user_email', $user_email);
        $req->bindParam(':user_password', $user_password);
        $req->execute();

        $result = $req->fetch();

        $this->endConnection();
        return $result;
    }

}

//------------------------ Verify Post --------------------------------

session_start();

if(isset($_POST['login']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_email = $_POST['user_email'];
    $user_password = md5(($_POST['user_password']));
    $verif = new Verify;
    $result = $verif->connectionUser($user_email, $user_password);
    if($verif = null){
        header('Location: ../index.php?info=1');
        exit;
    } else {
        if ($_POST['auth']) {
            setcookie("user_email", $result['user_email'], time() + 365*24*3600, "/");
            setcookie("user_password", $result['user_password'], time() + 365*24*3600, "/");

            $_COOKIE['user_email'] = $result['user_email'];
            $_COOKIE['user_password'] = $result['user_password'];
        }

        $_SESSION['user_id'] = $result['user_id'];
        $_SESSION['user_firstname'] = $result['user_firstname'];
        $_SESSION['user_lastname'] = $result['user_lastname'];
        $_SESSION['user_email'] = $result['user_email'];
        $_SESSION['user_password'] = $result['user_password'];
        $_SESSION['user_hierarchy'] = $result['user_hierarchy'];


        header('Location: ../home.php');
    }
} 

//------------------------ Verify Session --------------------------------

if(isset($_COOKIE['user_email']) && isset($_COOKIE['user_password'])) {
    $_SESSION['user_email'] = $_COOKIE['user_email'];
    $_SESSION['user_password'] = $_COOKIE['user_password'];
} else {
    if(isset($_SESSION['user_email']) && isset($_SESSION['user_password'])) {
        $verif = new Verify;
        $result = $verif->connectionUser($_SESSION['user_email'], $_SESSION['user_password']);
        if($verif = null){
            header('Location: ../index.php?info=1');
        } else {
            $_SESSION['user_id'] = $result['user_id'];
            $_SESSION['user_firstname'] = $result['user_firstname'];
            $_SESSION['user_lastname'] = $result['user_lastname'];
            $_SESSION['user_email'] = $result['user_email'];
            $_SESSION['user_password'] = $result['user_password'];
            $_SESSION['user_hierarchy'] = $result['user_hierarchy'];
        }
    } else {
        header('Location: ../index.php?info=1');
    }
}

//------------------------ Deconnection --------------------------------

if (isset($_GET['deco'])){
    session_destroy();
    setcookie("user_email", "", time() - 365*24*3600, "/");
    setcookie("user_password", "", time() - 365*24*3600, "/");
    header('Location:../index.php?info=2');
}

?>