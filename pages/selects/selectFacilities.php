<?php
session_start();
if(!isset($_SESSION["username"]) && !isset($_SESSION["password"])) {
    header('Location: ../../index.php?error=2');
}

require "../navbar.php";

//Get all members and facilities for foreign keys constraints
require "../../library/API/DatabaseAPI.php";
$api = new DatabaseAPI();
$facilitiesList = $api->selectAllFacilities();
?> 
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Select Facilities</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="../../styles/main.css" />
    <!--<script src="main.js"></script>-->
</head>

<body class="facilities">
    <a href="../selectAll"><button class="return" style="position:fixed;">Return</button></a>
    <div class="cards-wrapper">
        <?php foreach ($facilitiesList as $facility) { ?>
            <div class="card">
                <div class="facility-card-left">
                    <h1>#<?= $facility->facid ?></h1>
                </div>
                <div class="facility-card-right">
                    <div class="facility-card-name">
                        <h2><?= $facility->name ?></h2>
                    </div>
                    <div class="facility-card-prices">
                        <p><?= $facility->membercost ?></p>
                        <p><?= $facility->guestcost ?></p>
                        <p><?= $facility->initialoutlay ?></p>
                        <p><?= $facility->monthlymaintenance ?></p>
                    </div>
                </div>
        </div>
        <?php } ?>
    </div>
</body>

</html>