<?php
session_start();
if (!isset($_SESSION["username"]) && !isset($_SESSION["password"])) {
    header('Location: ../../index.php?error=2');
}
require "navbar.php";
require "../library/API/DatabaseAPI.php";
$api = new DatabaseAPI();
$admin_permissions = $api->checkDatabaseRoles($_SESSION["username"]);

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Requests</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="../styles/main.css" />
    <script src="../js/konami.js"></script>
</head>

<body>
    <h1>Connected</h1>

    <div class="buttons-wrapper">
        <?php if (count($admin_permissions) <= 0) : ?>
            <p>Cet Utilisateur n'a aucune Permission</p>
            <?php else : ?>
            <!--Check User permissions -->
            <?php foreach ($admin_permissions as $permission) { ?>
                <?php if (strpos($permission->case, 'superuser') !== false) : ?>
                    <a href="./manageUsers.php"><button>Manage Users</button></a>
                <?php endif; ?>
                <?php if (strpos($permission->case, 'CREATE DATABASE') !== false) : ?>
                    <a href="#"><button>Modify Database</button></a>
                <?php endif; ?>
                    <a href="#"><button>Navigate Database</button></a>
            <?php } ?>
        <?php endif; ?>
    </div>
</body>

</html>