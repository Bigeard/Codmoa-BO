<?php
session_start();
if(!isset($_SESSION["username"]) && !isset($_SESSION["password"])) {
    header('Location: ../../index.php?error=2');
}

//Get all members to choose recommendedby memID
require "../../library/API/DatabaseAPI.php";
$api = new DatabaseAPI();
$membersList = $api->selectAllMembers();
?> 
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Insert</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="../../styles/main.css" />
    <!--<script src="main.js"></script>-->
</head>

<body class="insertMember">
    <a href="../insert"><button class="return" style="position:fixed;">Return</button></a>
    <h1>Insert Member</h1>

    <form action="../../library/insertProcessing.php" method="POST">
        <label for="m_id">ID: </label>
        <input type="number" name="m_id" id="m_id" required>

        <label for="m_surname">Surname: </label>
        <input type="text" name="m_surname" id="m_surname" required>

        <label for="m_firstname">Firstname: </label>
        <input type="text" name="m_firstname" id="m_firstname" required>

        <label for="m_address">Address: </label>
        <input type="text" name="m_address" id="m_address" required>

        <label for="m_zipcode">Zipcode: </label>
        <input type="number" name="m_zipcode" id="m_zipcode" required>

        <label for="m_phone">Phone: </label>
        <input type="tel" name="m_phone" id="m_phone" required>

        <label for="m_recommendedby">Recommended By: </label>
        <select name="m_recommendedby" id="m_recommendedby">
            <?php foreach ($membersList as $member) { ?>
                <option value="<?= $member->memid ?>"><?= $member->memid . ' ' . $member->surname . ' ' . $member->firstname ?></option>
            <?php } ?>
        </select> 
        
        <input type="submit" value="Send">
    </form>
</body>

</html>