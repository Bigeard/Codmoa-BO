<?php
require_once 'ConnectionAPI.php';

class DatabaseAPI extends ConnectionAPI
{

    //Add USer
    public function createUser($username, $password, $isAdmin)
    {

        try {
            $this->connectDB($_SESSION["username"], $_SESSION["password"]);


            $sql1 = "CREATE USER $username WITH PASSWORD '$password';";
            $stmt1 = $this->connection->prepare($sql1);
            $stmt1->execute();

            $sql2 = "GRANT CONNECT ON DATABASE codmoa TO $username;";
            $stmt2 = $this->connection->prepare($sql2);
            $stmt2->execute();

            if ($isAdmin) {
                $sql3 = "ALTER USER $username WITH SUPERUSER CREATEDB;";
                $stmt3 = $this->connection->prepare($sql3);
                $stmt3->execute();
            }

            $this->disconnectDB();

            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    //Remove User
    public function removeUser($user)
    {
        try {
            $this->connectDB('postgres', 'P@ssw0rd');

            $sql1 = "REASSIGN OWNED BY $user TO trashbin;";
            $stmt1 = $this->connection->prepare($sql1);
            $stmt1->execute();

            $sql2 = "DROP OWNED BY $user;";
            $stmt2 = $this->connection->prepare($sql2);
            $stmt2->execute();

            $sql3 = "DROP USER $user;";
            $stmt3 = $this->connection->prepare($sql3);
            $stmt3->execute();

            $this->disconnectDB();

            return true;
        } catch (Exception $e) {
            return false;
        }
    }
    
    //Select all users
    public function selectAllUsers()
    {
        $this->connectDB('postgres', 'P@ssw0rd');

        $sql = "SELECT 
                    * 
                FROM 
                    pg_user;";

        $stmt = $this->connection->prepare($sql);
        $stmt->execute();

        $tab = [];
        while ($result = $stmt->fetch(PDO::FETCH_OBJ)) {
            $tab[] = $result;
        }
        $this->disconnectDB();

        return $tab;
    }
    
    //Select all tables
    public function selectAllTables() {

        $this->connectDB('postgres', 'P@ssw0rd');

        $sql = "SELECT 
                    * 
                FROM 
                    information_schema.tables
                WHERE 
                    table_schema != 'pg_catalog'
                AND 
                    table_schema != 'information_schema';";

        $stmt = $this->connection->prepare($sql);
        $stmt->execute();

        $tab = [];
        while ($result = $stmt->fetch(PDO::FETCH_OBJ)) {
            $tab[] = $result;
        }
        $this->disconnectDB();

        return $tab;
    }
    
    //Select all schemas
    public function selectAllSchemas() {

        $this->connectDB('postgres', 'P@ssw0rd');

        $sql = "SELECT DISTINCT
                    table_schema
                FROM 
                    information_schema.tables
                WHERE 
                    table_schema != 'pg_catalog'
                AND 
                    table_schema != 'information_schema';";

        $stmt = $this->connection->prepare($sql);
        $stmt->execute();

        $tab = [];
        while ($result = $stmt->fetch(PDO::FETCH_OBJ)) {
            $tab[] = $result;
        }
        $this->disconnectDB();

        return $tab;
    }

    //Check user role on database (superuser, create)
    public function checkDatabaseRoles($user)
    {
        $this->connectDB('postgres', 'P@ssw0rd');

        $sql = "SELECT u.usename,
                    CASE WHEN u.usesuper AND u.usecreatedb THEN CAST('superuser, CREATE DATABASE' AS pg_catalog.text)
                        WHEN u.usesuper THEN CAST('superuser' AS pg_catalog.text)
                        WHEN u.usecreatedb THEN CAST('create database' AS pg_catalog.text)
                        ELSE CAST('' AS pg_catalog.text)
                    END
                  FROM pg_catalog.pg_user u
                  WHERE u.usename = :user
                  ORDER BY 1;";

        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':user', $user);
        $stmt->execute();

        $tab = [];
        while ($result = $stmt->fetch(PDO::FETCH_OBJ)) {
            $tab[] = $result;
        }
        $this->disconnectDB();

        return $tab;
    }

    //Check if user has CONNECT permission on database
    public function checkConnectionRight($user)
    {
        $this->connectDB('postgres', 'P@ssw0rd');

        $sql = "SELECT has_database_privilege(:user, 'codmoa', 'CONNECT')";

        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':user', $user);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_OBJ);

        $this->disconnectDB();

        if ($result->has_database_privilege == "t") {
            return true;
        } else {
            return false;
        }
    }

    //Select permissions on all tables by user
    public function selectPermissionsByUser($user)
    {
        $this->connectDB('postgres', 'P@ssw0rd');

        $sql = "SELECT 
                    * 
                FROM 
                    information_schema.role_table_grants 
                WHERE 
                    table_schema != 'pg_catalog'
                AND 
                    table_schema != 'information_schema'
                AND
                    grantee = :user
                ORDER BY
                    table_schema;";

        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':user', $user);
        $stmt->execute();

        $tab = [];
        while ($result = $stmt->fetch(PDO::FETCH_OBJ)) {
            $tab[] = $result;
        }
        $this->disconnectDB();

        return $tab;
    }

    //Grant permission to user
    public function grantPermission($privilege, $schema, $table, $user)
    {
        try {
            $this->connectDB('postgres', 'P@ssw0rd');

            $sql = "GRANT 
                        $privilege
                    ON 
                        $schema.$table 
                    TO 
                        $user;";
    
            $stmt = $this->connection->prepare($sql);
            $stmt->execute();
    
            $this->disconnectDB();

            return true;
        }
        catch (Exception $e) {
            return $e;
        }
    }

    //Revoke permission to user
    public function revokePermission($privilege, $schema, $table, $user)
    {
        try {
            $this->connectDB('postgres', 'P@ssw0rd');

            $sql = "REVOKE 
                        $privilege
                    ON 
                        $schema.$table 
                    FROM 
                        $user;";
    
            $stmt = $this->connection->prepare($sql);
            $stmt->execute();
    
            $this->disconnectDB();

            return true;
        }
        catch (Exception $e) {
            return $e;
        }
    }
}
