<?php
require_once 'ConnectionAPI.php';

class DatabaseAPI extends ConnectionAPI
{

    //Usage of PDO
    public function createUser($username, $password, $isAdmin)
    {

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
    }

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

    public function isAdmin($user)
    {
        $this->connectDB('postgres', 'P@ssw0rd');

        $sql = "SELECT DISTINCT
                        privilege_type
                    FROM   
                        information_schema.role_table_grants
                    WHERE  
                        grantee = :user";

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
}
