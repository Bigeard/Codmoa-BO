<?php
session_start();
if(!isset($_SESSION["username"]) && !isset($_SESSION["password"])) {
    header('Location: ../../index.php?error=2');
}
require "../library/API/DatabaseAPI.php";
$api = new DatabaseAPI();
$schemas = $api->selectAllSchemas();
$tables = $api->selectAllTables();
$permissions = $api->selectPermissionsByUser($_POST["update_user"]);
?> 
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Update Permissions</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="../styles/main.css" />
    <!--<script src="main.js"></script>-->
</head>

<body class="permissions">
    <a href="./requests.php"><button class="return" style="position:fixed;">Return</button></a>
    <h1>Update Permissions for <?= $_POST["update_user"] ?></h1>

    <form action="../library/processing.php" method="POST">
        <div class="form-wrapper">
            <?php foreach ($schemas as $schema) { ?>
                <h1><?= $schema->table_schema ?></h1>

                <?php foreach ($tables as $table) { ?>
                    <?php if ($table->table_schema == $schema->table_schema) {?>
                        
                        <h2><?= $table->table_name ?></h2>

                        <div class="permissions-wrapper">
                            <div class="permission-item">
                                <label for="insert_<?= $table->table_schema ?>.<?= $table->table_name ?>">INSERT</label>
                                <input type="checkbox" name="insert_<?= $table->table_schema ?>.<?= $table->table_name ?>" id="insert_<?= $table->table_schema ?>.<?= $table->table_name ?>">
                            </div>
                            
                            <div class="permission-item">
                                <label for="select_<?= $table->table_schema ?>.<?= $table->table_name ?>">SELECT</label>
                                <input type="checkbox" name="select_<?= $table->table_schema ?>.<?= $table->table_name ?>" id="select_<?= $table->table_schema ?>.<?= $table->table_name ?>">
                            </div>      

                            <div class="permission-item">
                                <label for="update_<?= $table->table_schema ?>.<?= $table->table_name ?>">UPDATE</label>
                                <input type="checkbox" name="update_<?= $table->table_schema ?>.<?= $table->table_name ?>" id="update_<?= $table->table_schema ?>.<?= $table->table_name ?>">
                            </div>  

                            <div class="permission-item">
                                <label for="delete_<?= $table->table_schema ?>.<?= $table->table_name ?>">DELETE</label>
                                <input type="checkbox" name="delete_<?= $table->table_schema ?>.<?= $table->table_name ?>" id="delete_<?= $table->table_schema ?>.<?= $table->table_name ?>">
                            </div>  
                        </div>
                    <?php } ?>
                <?php } ?>
            <?php } ?>
        </div>
        
        
        <input type="submit" value="Update">
    </form>
</body>

</html>