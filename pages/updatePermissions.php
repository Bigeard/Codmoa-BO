<?php
session_start();
if(!isset($_SESSION["username"]) && !isset($_SESSION["password"])) {
    header('Location: ../../index.php?error=2');
}
require "../library/API/DatabaseAPI.php";
$api = new DatabaseAPI();
$users = $api->selectAllUsers();
?> 
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Update Permissions</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="../styles/main.css" />
    <!--<script src="main.js"></script>-->
</head>

<body>
    <a href="./requests.php"><button class="return" style="position:fixed;">Return</button></a>
    <h1>Update Permissions</h1>

    <form action="./updatePermissionsUser.php" method="POST">
        <select name="update_user">
            <?php foreach ($users as $user) { ?>
                <option value="<?= $user->usename ?>"><?= $user->usename ?></option>
            <?php } ?>
        </select>
        <input type="submit" value="Select">
    </form>
</body>

</html>