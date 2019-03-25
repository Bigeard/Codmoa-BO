<?php
session_start();
if(!isset($_SESSION["username"]) && !isset($_SESSION["password"])) {
    header('Location: ../../index.php?error=2');
}
require "navbar.php";
?> 
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Select All</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="../styles/main.css" />
    <!--<script src="main.js"></script>-->
</head>

<body>
    <a href="./requests"><button class="return" style="position:fixed;">Return</button></a>
    <h1>Select</h1>

    <div class="buttons-wrapper">
        <a href="selects/selectMembers.php"><button>All Members</button></a>
        <a href="selects/selectFacilities.php"><button>All Facilities</button></a>
        <a href="selects/selectBookings.php"><button>All Bookings</button></a>
    </div>

</body>

</html>