<?php require "../header.php"; ?> 
<?php require "../../library/API/DatabaseAPI.php";
$api = new DatabaseAPI();

$users = $api->selectAllUsers();

?>

<!-- <body> -->
    <a href="../requests.php" class="return">Return</a>
    <h1>Manage Users</h1>

    <div class="users-wrapper">
        <?php foreach ($users as $user) { ?>
            <div class="user-wrapper">
                <div class="user-left">
                    <h2><?= $user->usename ?></h2>
                </div>
                <div class="user-right">
                    <div class="icons-wrapper">
                        <a href="./updatePermissions.php?user=<?= $user->usename ?>" class="icon"><img src="../../assets/icons/edit.svg"></a>
                        <a href="../../library/processing.php?remove_user=<?= $user->usename ?>" class="icon"><img src="../../assets/icons/delete.svg"></a>
                    </div>
                </div>
            </div>
        <?php } ?>
        <a href="./addUser.php" class="addSchema">Add User</a>
    </div>


</body>

</html>