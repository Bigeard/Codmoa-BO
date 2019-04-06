<?php
session_start();
if(!isset($_SESSION["username"]) && !isset($_SESSION["password"])) {
    header('Location: ../index.php?error=2');
}
require "navbar.php";
?> 
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Insert</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="../styles/main.css" />
    <!--<script src="main.js"></script>-->
</head>

<body>
    <a href="./requests"><button class="return" style="position:fixed;">Return</button></a>
    <h1>Insert</h1>

    <div class="buttons-wrapper">
        <a href="inserts/insertMember.php"><button>New Member</button></a>
        <a href="inserts/insertFacility.php"><button>New Facility</button></a>
        <a href="inserts/insertBooking.php"><button>New Booking</button></a>
    </div>
</body>

</html>