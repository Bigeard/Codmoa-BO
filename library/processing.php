<?php
session_start();
require_once 'API/DatabaseAPI.php';

//Add User
if (isset($_POST["add_username"]) && isset($_POST["add_password"])) {
    $insert = new DatabaseAPI();
    if (!isset($_POST['add_isAdmin'])) {
        $_POST['add_isAdmin'] = null;
    }
    if ($insert->createUser($_POST['add_username'], $_POST['add_password'], $_POST['add_isAdmin'])) {
        header('Location: ../pages/requests.php');
        exit;
    } else {
        header('Location: ../pages/createUser.php?error=1');
        exit;
    }
}

//Remove User
elseif (isset($_POST["remove_user"])) {
    $remove = new DatabaseAPI();
    if ($remove->removeUser($_POST['remove_user'])) {
        header('Location: ../pages/requests.php');
        exit;
    } else {
        header('Location: ../pages/removeUser.php?error=1');
        exit;
    }
}

//Add Schema
elseif (isset($_POST["add_schema_name"])) {
    $schema = new DatabaseAPI();
    if ($schema->createSchema($_POST['add_schema_name'])) {
        header('Location: ../pages/requests.php');
        exit;
    } else {
        header('Location: ../pages/createSchema.php?error=1');
        exit;
    }
}

//Update permissions of User
elseif (isset($_POST["update_user"])) {
    try {
        //Retrieve All Schemas, tables and user permissions
        $api = new DatabaseAPI();
        $schemas = $api->selectAllSchemas();
        $tables = $api->selectAllTables();
        $permissions = $api->selectPermissionsByUser($_POST["update_user"]);

        foreach ($schemas as $schema) {
            foreach ($tables as $table) {
                if ($table->table_schema == $schema->table_schema) {

                    //Test SELECT Permission
                    foreach ($_POST as $updatePermisssion => $value) {
                        if (strpos($updatePermisssion, $schema->table_schema) !== false && strpos($updatePermisssion, $table->table_name) !== false && strpos($updatePermisssion, 'insert') !== false) {
                            try {
                                $api->grantPermission('INSERT', $schema->table_schema, $table->table_name, $_POST['update_user']);
                                break;
                            } catch (Exception $e) {
                                header('Location: ../pages/requests.php?error=1');
                                exit;
                            }
                        } else {
                            $api->revokePermission('INSERT', $schema->table_schema, $table->table_name, $_POST['update_user']);
                        }
                    }

                    //Test INSERT Permission
                    foreach ($_POST as $updatePermisssion => $value) {
                        if (strpos($updatePermisssion, $schema->table_schema) !== false && strpos($updatePermisssion, $table->table_name) !== false && strpos($updatePermisssion, 'select') !== false) {
                            try {
                                $api->grantPermission('SELECT', $schema->table_schema, $table->table_name, $_POST['update_user']);
                                break;
                            } catch (Exception $e) {
                                header('Location: ../pages/requests.php?error=1');
                                exit;
                            }
                        } else {
                            $api->revokePermission('SELECT', $schema->table_schema, $table->table_name, $_POST['update_user']);
                        }
                    }

                    //Test UPDATE Permission
                    foreach ($_POST as $updatePermisssion => $value) {
                        if (strpos($updatePermisssion, $schema->table_schema) !== false && strpos($updatePermisssion, $table->table_name) !== false && strpos($updatePermisssion, 'update') !== false) {
                            try {
                                $api->grantPermission('UPDATE', $schema->table_schema, $table->table_name, $_POST['update_user']);
                                break;
                            } catch (Exception $e) {
                                header('Location: ../pages/requests.php?error=1');
                                exit;
                            }
                        } else {
                            $api->revokePermission('UPDATE', $schema->table_schema, $table->table_name, $_POST['update_user']);
                        }
                    }

                    //Test DELETE Permission
                    foreach ($_POST as $updatePermisssion => $value) {
                        if (strpos($updatePermisssion, $schema->table_schema) !== false && strpos($updatePermisssion, $table->table_name) !== false && strpos($updatePermisssion, 'delete') !== false) {
                            try {
                                $api->grantPermission('DELETE', $schema->table_schema, $table->table_name, $_POST['update_user']);
                                break;
                            } catch (Exception $e) {
                                header('Location: ../pages/requests.php?error=1');
                                exit;
                            }
                        } else {
                            $api->revokePermission('DELETE', $schema->table_schema, $table->table_name, $_POST['update_user']);
                        }
                    }
                }
            }
        }
        header('Location: ../pages/requests.php');
        exit;
    } catch (Exception $e) {
        header('Location: ../pages/requests.php?updateError=1');
        exit;
    }
}


//Remove Table
elseif ($_GET['remove'] && isset($_GET['schema']) && isset($_GET['table'])) {
    $remove = new DatabaseAPI();
    if ($remove->removeTable($_GET['schema'], $_GET['table'])) {
        header('Location: ../pages/modifyDb.php');
        exit;
    } else {
        header('Location: ../pages/modifyDb.php?error=1');
    }
}

//Remove Schema
elseif ($_GET['remove'] && isset($_GET['schema']) && !isset($_GET['table'])) {
    $remove = new DatabaseAPI();
    if ($remove->removeSchema($_GET['schema'])) {
        header('Location: ../pages/modifyDb.php');
        exit;
    } else {
        header('Location: ../pages/modifyDb.php?error=1');
    }
}

//Add Table
else if ($_GET['add'] && isset($_GET['schema']) && isset($_GET['table'])) {
    $add = new DatabaseAPI();
    if ($add->addTable($_GET['schema'], $_GET['table'])) {
        header('Location: ../pages/modifyDb.php');
        exit;
    } else {
        header('Location: ../pages/modifyDb.php?error=1');
    }
}

//Add Schemas
else if ($_GET['add'] && isset($_GET['schema']) && !isset($_GET['table'])) {
    $add = new DatabaseAPI();
    if ($add->addSchema($_GET['schema'])) {
        header('Location: ../pages/modifyDb.php');
        exit;
    } else {
        header('Location: ../pages/modifyDb.php?error=1');
    }
}

