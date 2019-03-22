<?php
    class Connection{

        private static $instance = null;

        const HOST = '127.0.0.1';
        const PORT = '5432';
        const DBNAME = 'codmoa';

        const DNS = 'pgsql:host=' . self::HOST . ';port=' . self::PORT . ';dbname=' . self::DBNAME;

        public static function startConnection($user, $password){
            try{
                self::$instance = new PDO(self::DNS, $user, $password, array( PDO::ATTR_TIMEOUT => 100, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ));
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return self::$instance;
            
            }catch (PDOException $e){
                die($e->getMessage());
                echo $e;
                return null;
            }
        }

        public static function endConnection(){
            self::$instance = null;
        }
    }
?>
