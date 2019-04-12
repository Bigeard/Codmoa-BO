<?php
require "../header.php"; 
require "../../library/API/DatabaseAPI.php";
$api = new DatabaseAPI();
$schemas = $api->selectAllSchemas();
$tables = $api->selectAllTables();
$permissions = $api->selectPermissionsByUser($_GET["user"]);
?> 

<body class="permissions">
    <a href="./manageUsers.php" class="return">Return</a>
    <h1>Update Permissions for <?= $_GET["user"] ?></h1>

    <form action="../../library/processing.php" method="POST">
        <div class="form-wrapper">
            <?php foreach ($schemas as $schema) { ?>
                <h1><?= $schema->schema_name ?></h1>

                <?php foreach ($tables as $table) { ?>
                    <?php if ($table->table_schema == $schema->schema_name) {?>
                        
                        <h2><?= $table->table_name ?></h2>

                        <div class="permissions-wrapper">
                            <div class="permission-item">
                                <label for="insert_<?= $table->table_schema ?>.<?= $table->table_name ?>">INSERT</label>
                                <?php foreach ($permissions as $index=>$permission) { ?>
                                    <?php if ($permission->table_schema == $schema->schema_name && $permission->table_name == $table->table_name && $permission->privilege_type == 'INSERT') : ?>
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
                                <?php foreach ($permissions as $index=>$permission) { ?>
                                    <?php if ($permission->table_schema == $schema->schema_name && $permission->table_name == $table->table_name && $permission->privilege_type == 'SELECT') : ?>
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
                                <?php foreach ($permissions as $index=>$permission) { ?>
                                    <?php if ($permission->table_schema == $schema->schema_name && $permission->table_name == $table->table_name && $permission->privilege_type == 'UPDATE') : ?>
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
                                <?php foreach ($permissions as $index=>$permission) { ?>
                                    <?php if ($permission->table_schema == $schema->schema_name && $permission->table_name == $table->table_name && $permission->privilege_type == 'DELETE') : ?>
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
        
        <input type="hidden" id="update_user" name="update_user" value="<?php echo $_GET["user"] ?>">
        
        <input type="submit" value="Update">
    </form>
</body>

</html>