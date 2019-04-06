<?php
session_start();
require_once './API/ConnectionAPI.php';

class Import extends ConnectionAPI
{

    //Add User
    public function importDb($sql)
    {
        try {
            echo $_SESSION["username"];
            echo $_SESSION["password"];
            
            $this->connectDB($_SESSION["username"], $_SESSION["password"]);
            $stmt = $this->connection->prepare($sql);
            $stmt->execute();

            $this->disconnectDB();

            return true;
        } catch (Exception $e) {
            return false;
        }
    }

}

$import = new Import();
$query = '';
$sqlScript = file('../test.sql');
foreach ($sqlScript as $line)	{
	
	$startWith = substr(trim($line), 0 ,2);
	$endWith = substr(trim($line), -1 ,1);
	
	if (empty($line) || $startWith == '--' || $startWith == '/*' || $startWith == '//') {
		continue;
	}
		
	$query = $query . $line;
	if ($endWith == ';') {
		$import->importDb($query) or die('<div class="error-response sql-import-response">Problem in executing the SQL query <b>' . $query. '</b></div>');
		$query= '';		
	}
}
echo '<div class="success-response sql-import-response">SQL file imported successfully</div>';