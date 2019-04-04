<?php
session_start();
require_once 'API/DatabaseAPI.php';

if (isset($_POST["add_username"]) && isset($_POST["add_password"])) {
    $insert = new DatabaseAPI();
    if (!isset($_POST['add_isAdmin'])) {
        $_POST['add_isAdmin'] = null;
    }
    if ($insert->createUser($_POST['add_username'], $_POST['add_password'], $_POST['add_isAdmin'])) {
        header('Location: ../pages/requests.php');
        exit;
    }
    else {
        header('Location: ../pages/createUser.php?error=1');
        exit;
    }
} 

elseif (isset($_POST["remove_user"])) {
    $remove = new DatabaseAPI();
    if ($remove->removeUser($_POST['remove_user'])) {
        header('Location: ../pages/requests.php');
        exit;
    }
    else {
        header('Location: ../pages/removeUser.php?error=1');
        exit;
    }
    
}
