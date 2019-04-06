<?php
session_start();
if(!isset($_SESSION["username"]) && !isset($_SESSION["password"])) {
    header('Location: ../index.php?error=2');
}
require "../library/API/DatabaseAPI.php";

//Retrieve All Schemas, tables and user permissions
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
            <!--List all schemas -->
            <?php foreach ($schemas as $schema) { ?>
                <h1><?= $schema->table_schema ?></h1>

                <!--List all tables -->
                <?php foreach ($tables as $table) { ?>
                    <!--Print table if in schema -->
                    <?php if ($table->table_schema == $schema->table_schema) {?>
                        
                        <h2><?= $table->table_name ?></h2>

                        <div class="permissions-wrapper">
                            <div class="permission-item">
                                <label for="insert_<?= $table->table_schema ?>.<?= $table->table_name ?>">INSERT</label>
                                
                                <!--Test if the user has this permissions -->
                                <?php foreach ($permissions as $index=>$permission) { ?>
                                    <?php if ($permission->table_schema == $schema->table_schema && $permission->table_name == $table->table_name && $permission->privilege_type == 'INSERT') : ?>
                                        <input type="checkbox" name="insert_<?= $table->table_schema ?>.<?= $table->table_name ?>" id="insert_<?= $table->table_schema ?>.<?= $table->table_name ?>" checked>
                                        <?php break; ?>
                                    <?php else : ?>
                                        <?php if($index >= count($permissions) -1 || !$permissions) : ?>
                                            <input type="checkbox" name="insert_<?= $table->table_schema ?>.<?= $table->table_name ?>" id="insert_<?= $table->table_schema ?>.<?= $table->table_name ?>">
                                        <?php endif; ?>
                                    <?php endif; ?>
                                <?php } ?>
                                <?php if (!$permissions) : ?>
                                    <input type="checkbox" name="insert_<?= $table->table_schema ?>.<?= $table->table_name ?>" id="insert_<?= $table->table_schema ?>.<?= $table->table_name ?>">
                                <?php endif; ?>
                            </div>
                            
                            <div class="permission-item">
                                <label for="select_<?= $table->table_schema ?>.<?= $table->table_name ?>">SELECT</label>

                                 <!--Test if the user has this permissions -->
                                <?php foreach ($permissions as $index=>$permission) { ?>
                                    <?php if ($permission->table_schema == $schema->table_schema && $permission->table_name == $table->table_name && $permission->privilege_type == 'SELECT') : ?>
                                        <input type="checkbox" name="select_<?= $table->table_schema ?>.<?= $table->table_name ?>" id="select_<?= $table->table_schema ?>.<?= $table->table_name ?>" checked>
                                        <?php break; ?>
                                    <?php else : ?>
                                        <?php if($index >= count($permissions) -1) : ?>
                                            <input type="checkbox" name="select_<?= $table->table_schema ?>.<?= $table->table_name ?>" id="select_<?= $table->table_schema ?>.<?= $table->table_name ?>">
                                        <?php endif; ?>
                                    <?php endif; ?>
                                <?php } ?>
                                <?php if (!$permissions) : ?>
                                    <input type="checkbox" name="select_<?= $table->table_schema ?>.<?= $table->table_name ?>" id="select_<?= $table->table_schema ?>.<?= $table->table_name ?>">
                                <?php endif; ?>
                            </div>      

                            <div class="permission-item">
                                <label for="update_<?= $table->table_schema ?>.<?= $table->table_name ?>">UPDATE</label>

                                 <!--Test if the user has this permissions -->
                                <?php foreach ($permissions as $index=>$permission) { ?>
                                    <?php if ($permission->table_schema == $schema->table_schema && $permission->table_name == $table->table_name && $permission->privilege_type == 'UPDATE') : ?>
                                        <input type="checkbox" name="update_<?= $table->table_schema ?>.<?= $table->table_name ?>" id="update_<?= $table->table_schema ?>.<?= $table->table_name ?>" checked>
                                        <?php break; ?>
                                    <?php else : ?>
                                        <?php if($index >= count($permissions) -1) : ?>
                                            <input type="checkbox" name="update_<?= $table->table_schema ?>.<?= $table->table_name ?>" id="update_<?= $table->table_schema ?>.<?= $table->table_name ?>">
                                        <?php endif; ?>
                                    <?php endif; ?>
                                <?php } ?>
                                <?php if (!$permissions) : ?>
                                    <input type="checkbox" name="update_<?= $table->table_schema ?>.<?= $table->table_name ?>" id="update_<?= $table->table_schema ?>.<?= $table->table_name ?>">
                                <?php endif; ?>
                            </div>  

                            <div class="permission-item">
                                <label for="delete_<?= $table->table_schema ?>.<?= $table->table_name ?>">DELETE</label>

                                 <!--Test if the user has this permissions -->
                                <?php foreach ($permissions as $index=>$permission) { ?>
                                    <?php if ($permission->table_schema == $schema->table_schema && $permission->table_name == $table->table_name && $permission->privilege_type == 'DELETE') : ?>
                                        <input type="checkbox" name="delete_<?= $table->table_schema ?>.<?= $table->table_name ?>" id="delete_<?= $table->table_schema ?>.<?= $table->table_name ?>" checked>
                                        <?php break; ?>
                                    <?php else : ?>
                                        <?php if($index >= count($permissions) -1) : ?>
                                            <input type="checkbox" name="delete_<?= $table->table_schema ?>.<?= $table->table_name ?>" id="delete_<?= $table->table_schema ?>.<?= $table->table_name ?>">
                                        <?php endif; ?>
                                    <?php endif; ?>
                                <?php } ?>
                                <?php if (!$permissions) : ?>
                                    <input type="checkbox" name="delete_<?= $table->table_schema ?>.<?= $table->table_name ?>" id="delete_<?= $table->table_schema ?>.<?= $table->table_name ?>">
                                <?php endif; ?>
                            </div>  
                        </div>
                    <?php } ?>
                <?php } ?>
            <?php } ?>
        </div>
        
        <input type="hidden" id="update_user" name="update_user" value="<?php echo $_POST["update_user"] ?>">
        
        <input type="submit" value="Update">
    </form>
</body>

</html>