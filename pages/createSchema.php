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
    <title>Create Schema</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="../styles/main.css" />
    <!--<script src="main.js"></script>-->
</head>

<body>
    <a href="./modifyDb.php" class="return">Return</a>
    <h1>Create Schema</h1>

    <form action="../library/processing.php" method="POST">
        <div class="form-wrapper">
            <label for="schema_name">Name: </label>
            <input type="text" name="schema_name" id="schema_name" required>
        </div>
        <input type="submit" value="Send">
    </form>

    <?php if(isset($_GET['error'])) { ?>
        <?php if($_GET['error'] == 1) : ?>
            <p>Error while creating schema</p>            
        <?php endif; ?>
    <?php } ?>
</body>

</html>