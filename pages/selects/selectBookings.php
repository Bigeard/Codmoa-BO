<?php
session_start();
if(!isset($_SESSION["username"]) && !isset($_SESSION["password"])) {
    header('Location: ../../index.php?error=2');
}

require "../navbar.php";

require "../../library/API/DatabaseAPI.php";
$api = new DatabaseAPI();
$bookingsList = $api->selectAllBookings();
?> 
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Select Bookings</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="../../styles/main.css" />
    <!--<script src="main.js"></script>-->
</head>

<body class="bookings">
    <a href="../selectAll"><button class="return" style="position:fixed;">Return</button></a>
    <div class="cards-wrapper">
        <?php foreach ($bookingsList as $booking) { 
            $timestamp = strtotime($booking->starttime);?>
            <div class="card">
                <div class="booking-card-left">
                    <h1>#<?= $booking->bookid ?></h1>
                    <p><?= $format = date('d/m/Y',$timestamp) ?></p>
                </div>
                <div class="booking-card-right">
                    <div class="booking-card-member">
                        <h2><?= $booking->surname ?> <?= $booking->firstname ?></h2>
                    </div>
                    <div class="booking-card-label">
                        <p><?= $booking->name ?></p>
                        <p><?= $booking->slots ?></p>
                    </div>
                </div>
        </div>
        <?php } ?>
    </div>
</body>

</html>