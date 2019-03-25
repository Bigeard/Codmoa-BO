<?php
session_start();
if(!isset($_SESSION["username"]) && !isset($_SESSION["password"])) {
    header('Location: ../../index.php?error=2');
}

//Get all members and facilities for foreign keys constraints
require "../../library/API/DatabaseAPI.php";
$api = new DatabaseAPI();
$membersList = $api->selectAllMembers();
$facilitiesList = $api->selectAllFacilities();

?> 
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Insert Booking</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="../../styles/main.css" />
    <!--<script src="main.js"></script>-->
</head>

<body>
    <a href="../insert"><button class="return" style="position:fixed;">Return</button></a>
    <h1>Insert Booking</h1>

    <form action="../../library/insertProcessing.php" method="POST">
        <div class="form-wrapper">
            <label for="b_id">ID: </label>
            <input type="number" name="b_id" id="b_id" required>

            <label for="b_facid">Facility ID: </label>
            <select name="b_facid" id="b_facid">
                <?php foreach ($facilitiesList as $facility) { ?>
                    <option value="<?= $facility->facid ?>"><?= $facility->facid . ' ' . $facility->name ?></option>
                <?php } ?>
            </select> 

            <label for="b_memid">Member ID: </label>
            <select name="b_memid" id="b_memid">
                <?php foreach ($membersList as $member) { ?>
                    <option value="<?= $member->memid ?>"><?= $member->memid . ' ' . $member->firstname . ' ' . $member->surname ?></option>
                <?php } ?>
            </select>

            <label for="b_starttime">Start Time: </label>
            <input type="date" name="b_starttime" id="b_starttime" required>

            <label for="b_slots">Slots: </label>
            <input type="number" name="b_slots" id="b_slots" required>
        </div>
        <input type="submit" value="Send">
    </form>
</body>

</html>