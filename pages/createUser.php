<?php
session_start();
if(!isset($_SESSION["username"]) && !isset($_SESSION["password"])) {
    header('Location: ../index.php?error=2');
}
?> 
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Create User</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="../styles/main.css" />
    <!--<script src="main.js"></script>-->
</head>

<body>
    <a href="./requests.php"><button class="return" style="position:fixed;">Return</button></a>
    <h1>Create User</h1>

    <form action="../library/processing.php" method="POST">
        <div class="form-wrapper">
            <label for="user_name">Name: </label>
            <input type="text" name="add_username" id="user_name" required>

            <label for="user_password">Password: </label>
            <input type="password" name="add_password" id="user_password" required>

            <label for="user_isAdmin">Super Admin: </label>
            <input type="checkbox" name="add_isAdmin" id="user_isAdmin">
        </div>
        <input type="submit" value="Send">
    </form>

    <?php if(isset($_GET['error'])) { ?>
        <?php if($_GET['error'] == 1) : ?>
            <p>Error while creating user</p>            
        <?php endif; ?>
    <?php } ?>
</body>

</html>