<?php
    require_once 'PDOConnection.php';

    class ConnectionAPI {
        protected $connection;

        //Connect to DB
        public function connectDB($user, $password){
            $this->connection = PDOConnection::connectDB($user, $password);
        }

        //Disconnect from DB
        public function disconnectDB(){
            $this->connection = PDOConnection::disconnectDB();
        }
    }
?>