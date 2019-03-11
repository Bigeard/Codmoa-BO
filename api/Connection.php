<?php
    class Connection{

        private static $instance = null;

        const USER = "XXXuserXXX";
        const PASSWORD = "XXXpasswordXXX";
        const DNS = 'pgsql:host=127.0.0.1;port=5432;dbname=XXXdatabaseXXX';

        public static function startConnection(){
            try{
                self::$instance = new PDO(self::DNS, self::USER, self::PASSWORD,  array( PDO::ATTR_TIMEOUT => 100, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ));
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$instance->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
                return self::$instance;
            
            }catch (PDOException $e){
                die($e->getMessage());
                echo $e;
                header('Location:../index.php');
                return null;
            }
        }

        public static function endConnection(){
            self::$instance = null;
        }
    }
?>
