<?php
session_start();
if(!isset($_SESSION["username"]) && !isset($_SESSION["password"])) {
    header('Location: ../../index.php?error=2');
}

require "../navbar.php";

//Get all members and facilities for foreign keys constraints
require "../../library/API/DatabaseAPI.php";
$api = new DatabaseAPI();
$membersList = $api->selectAllMembers();
?> 
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Select Members</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="../../styles/main.css" />
    <!--<script src="main.js"></script>-->
</head>

<body class="members">
    <a href="../selectAll"><button class="return" style="position:fixed;">Return</button></a>
    <div class="cards-wrapper">
        <?php foreach ($membersList as $member) { 
            $timestamp = strtotime($member->joindate);?>
            <div class="card">
                <div class="member-card-left">
                    <h1>#<?= $member->memid ?></h1>
                    <p><?= $format = date('d/m/Y',$timestamp) ?></p>
                </div>
                <div class="member-card-right">
                    <div class="member-card-member">
                        <h2><?= $member->surname ?> <?= $member->firstname ?></h2>
                    </div>
                    <div class="member-card-label">
                        <p><?= $member->address ?></p>
                        <p><?= $member->zipcode ?></p>
                    </div>
                    <div class="member-card-label">
                        <p><?= $member->telephone ?></p>
                        <p><?= $member->recommendedby ?></p>
                    </div>
                </div>
        </div>
        <?php } ?>
    </div>
</body>

</html>