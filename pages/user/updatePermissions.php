<?php 
require "../header.php"; 
require "../../library/API/DatabaseAPI.php";
$api = new DatabaseAPI();
$users = $api->selectAllUsers();
?> 

<!-- <body> -->
    <a href="./manageUsers.php" class="return">Return</a>
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