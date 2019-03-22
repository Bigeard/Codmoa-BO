<?php
require_once './ServicesConnection.php';

require_once './ServicesUser.php';

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