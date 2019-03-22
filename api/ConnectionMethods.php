<?php
    require_once 'Connection.php';
    
    class connectionMethods {
        protected $connection;

        public function startConnection($user, $password){
            $this->connection = Connection::startConnection($user, $password);
        }

        public function endConnection(){
            $this->connection = Connection::endConnection();
        }
    }
?>