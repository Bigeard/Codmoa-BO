<?php require "../header.php"; ?> 

<!-- <body> -->
    <a href="./manageUsers.php" class="return">Return</a>
    <h1>Remove User</h1>

    <form action="../../library/processing.php" method="POST">
        <select name="remove_user">
            <?php foreach ($users as $user) { ?>
                <option value="<?= $user->usename ?>"><?= $user->usename ?></option>
            <?php } ?>
        </select>
        <input type="submit" value="Remove">
    </form>

    <?php if(isset($_GET['error'])) { ?>
        <?php if($_GET['error'] == 1) : ?>
            <p>Unable to remove user</p>
        <?php endif; ?>
    <?php } ?>
</body>

</html>