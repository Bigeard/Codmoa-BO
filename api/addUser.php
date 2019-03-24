<?php
require_once './ServicesConnection.php';

require_once './ServicesUser.php';

if(isset($_POST['signup']) &&
    isset($_POST['user']) &&
    isset($_POST['password']) &&
    isset($_POST['privileges']) &&
    isset($_POST['tables']) &&
    $_SERVER['REQUEST_METHOD'] === 'POST') {

        $service = new ServicesUser;
        $result = $service->addUser($_POST['user'], $_POST['password'], $_POST['privileges'], $_POST['tables']);

        if($result) {
            header('Location: ../index.php?info=3');
        } else {
            header('Location: ../signup.php?info=1');
        }

} else {
    header('Location: ../signup.php?info=2');
}