<?php
require "./header.php";
require "../library/API/DatabaseAPI.php";
$api = new DatabaseAPI();
$admin_permissions = $api->checkDatabaseRoles($_SESSION["username"]);
?>

<!-- <body> -->
    <h1>Connected</h1>

    <div class="buttons-wrapper">
        <?php if (count($admin_permissions) <= 0) : ?>
            <p>Cet Utilisateur n'a aucune Permission</p>
        <?php else : ?>
            <!--Check User permissions -->
            <?php foreach ($admin_permissions as $permission) { ?>
                <a href="./navigateDb.php">Navigate Database</a>
                <?php if (strpos($permission->case, 'CREATE DATABASE') !== false) : ?>
                    <a href="./modifyDb.php">Modify Database</a>
                    <a href="./importDb.php">Import Database</a>
                <?php endif; if (strpos($permission->case, 'superuser') !== false) :?>
                    <a href="./user/manageUsers.php">Manage Users</a>
                <?php endif; ?>
            <?php } ?>
        <?php endif; ?>
    </div>

    <?php if (isset($_GET['updateError'])) { ?>
        <p>Error while Updating permissions</p>
    <?php } ?>
</body>
</html>