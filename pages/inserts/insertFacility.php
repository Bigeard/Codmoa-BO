<?php
session_start();
if(!isset($_SESSION["username"]) && !isset($_SESSION["password"])) {
    header('Location: ../../index.php?error=2');
}

?> 
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Insert Facility</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="../../styles/main.css" />
    <!--<script src="main.js"></script>-->
</head>

<body class="insertFacility">
    <a href="../insert"><button class="return" style="position:fixed;">Return</button></a>
    <h1>Insert Facility</h1>

    <form action="../../library/insertProcessing.php" method="POST">
        <div class="form-wrapper">
            <label for="f_id">ID: </label>
            <input type="number" name="f_id" id="f_id" required>

            <label for="f_name">Name: </label>
            <input type="text" name="f_name" id="f_name" required>

            <label for="f_membercost">Member Cost: </label>
            <input type="number" name="f_membercost" id="f_membercost" required>

            <label for="f_guestcost">Guest Cost: </label>
            <input type="number" name="f_guestcost" id="f_guestcost" required>

            <label for="f_initialoutlay">Initial Outlay: </label>
            <input type="number" name="f_initialoutlay" id="f_initialoutlay" required>

            <label for="f_monthlymaintenance">Monthly Maintenance: </label>
            <input type="number" name="f_monthlymaintenance" id="f_monthlymaintenance" required>
        </div>
        <input type="submit" value="Send">
    </form>
</body>

</html>