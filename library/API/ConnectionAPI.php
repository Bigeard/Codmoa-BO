<?php
    require_once 'PDOConnection.php';

    class ConnectionAPI {
        protected $connection;

        public function connectDB($user, $password){
            $this->connection = PDOConnection::connectDB($user, $password);
        }

        public function disconnectDB(){
            $this->connection = PDOConnection::disconnectDB();
        }
    }
?>