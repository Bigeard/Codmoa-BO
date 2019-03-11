<?php
require_once './api/ServicesConnection.php';
?> 

<!DOCTYPE html>
<html>
<head>
    <title>User</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css" />
</head>
<body>
    <div class="user content con">
        <img class="user-img" src="./img/users_img/img_default.svg" alt="<?= $_SESSION['user_firstname'] ?> image">
        <h2><?= $_SESSION['user_firstname'] ?> <?= $_SESSION['user_lastname'] ?></h2>
        <p><?= $_SESSION['user_email'] ?></p>
        <p>Id : <?= $_SESSION['user_id'] ?></p>
        <p>Hierarchy: <?= $_SESSION['user_hierarchy'] ?></p>
        <a href="./home.php">Home</a>
        <a href="api/ServicesConnection.php?deco=1">Disconnect</a>
    </div>
</body>
</html>