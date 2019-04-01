<?php 
session_start();
require_once 'API/DatabaseAPI.php';

if (isset($_POST["m_id"])) {
    $insert = new DatabaseAPI();
    $insert->insertMember($_POST['m_id'], $_POST['m_surname'], $_POST['m_firstname'], $_POST['m_address'], $_POST['m_zipcode'], $_POST['m_phone'], $_POST['m_recommendedby']);
    header('Location: ../pages/requests.php');
    exit;
}

elseif (isset($_POST["f_id"])) {
    $insert = new DatabaseAPI();
    $insert->insertFacility($_POST['f_id'], $_POST['f_name'], $_POST['f_membercost'], $_POST['f_guestcost'], $_POST['f_initialoutlay'], $_POST['f_monthlymaintenance']);
    header('Location: ../pages/requests.php');
    exit;
}

elseif (isset($_POST["b_id"])) {
    $insert = new DatabaseAPI();
    $insert->insertBooking($_POST['b_id'], $_POST['b_facid'], $_POST['b_memid'], $_POST['b_starttime'], $_POST['b_slots']);
    header('Location: ../pages/requests.php');
    exit;
}

elseif (isset($_POST["user_name"])) {
    $insert = new DatabaseAPI();
    if (!isset($_POST['user_isAdmin'])) {$_POST['user_isAdmin'] = null;}
    $insert->createUser($_POST['user_name'], $_POST['user_password'], $_POST['user_isAdmin']);
    header('Location: ../pages/requests.php');
    exit;
}


?>