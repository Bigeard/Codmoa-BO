<?php require "../header.php"; ?> 
    <a href="./manageUsers.php" class="return" style="position:fixed;">Return</a>
    <h1>Create User</h1>

    <form action="../../library/processing.php" method="POST">
        <div class="form-wrapper">
            <label for="add_username">Name: </label>
            <input type="text" name="add_username" id="add_username" required>

            <label for="add_password">Password: </label>
            <input type="password" name="add_password" id="add_password" required>

            <label for="add_isAdmin">Super Admin: </label>
            <input type="checkbox" name="add_isAdmin" id="add_isAdmin">
        </div>
        <input type="submit" value="Send">
    </form>
</body>

</html>