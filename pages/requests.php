<?php
session_start();
if(!isset($_SESSION["username"]) && !isset($_SESSION["password"])) {
    header('Location: ../../index.php?error=2');
}
require "navbar.php";
require "../library/API/DatabaseAPI.php";
$api = new DatabaseAPI();
$permissions_list = $api->checkRoles($_SESSION["username"]);
$admin_permissions = $api->isAdmin($_SESSION["username"]);

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
        <?php if (count($permissions_list) <= 0 && count($admin_permissions) <= 0) : ?>
            <p>Cet Utilisateur n'a aucune Permission</p>
        <?php else : ?>
            <!--Check User permissions -->
            <?php foreach ($permissions_list as $permission) { ?>
                <?php if ($permission->privilege_type == "SELECT"): ?>
                    <a href="selectAll.php"><button>Select All</button></a>
                <?php elseif ($permission->privilege_type == "INSERT"): ?>
                    <a href="insert.php"><button>Insert</button></a>
                <?php endif; ?>
            <?php } ?>

            <!--Check Admin permissions -->
            <?php foreach ($admin_permissions as $permission) { ?>
                <?php if ($permission->privilege_type == "INSERT"): ?>
                    <a href="createUser.php"><button>Create User</button></a>
                <?php elseif ($permission->privilege_type == "UPDATE"): ?>
                    <a href="insert.php"><button>Manage Permissions</button></a>
                <?php endif; ?>
            <?php } ?>
            <?php endif; ?>
    </div>
</body>

</html>