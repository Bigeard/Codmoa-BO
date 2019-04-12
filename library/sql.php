<?php
session_start();
require_once './API/ConnectionAPI.php';

class Sql extends ConnectionAPI
{
    public function executeSQL($sql)
    {
        try {            
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

if(isset($_POST["script"])) {
    echo $_POST["sql"];
    $script = new Sql();
    $script->executeSQL($_POST["sql"]);
}

if(isset($_POST["import"])) {
    $target_file = "../tmp/" . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $FileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    if($_FILES['fileToUpload']['error'] == 0 && is_uploaded_file($_FILES['fileToUpload']['tmp_name'])){
        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }
        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 10000000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        // Allow certain file formats
        if($FileType != "sql" ) {
            echo "Sorry, only SQL file are allowed.";
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
                $import = new Sql();
                $query = '';
                $sqlScript = file($target_file);
                foreach ($sqlScript as $line)	{
                    
                    $startWith = substr(trim($line), 0 ,2);
                    $endWith = substr(trim($line), -1 ,1);
                    
                    if (empty($line) || $startWith == '--' || $startWith == '/*' || $startWith == '//') {
                        continue;
                    }
                        
                    $query = $query . $line;
                    if ($endWith == ';') {
                
                $import->executeSQL($query) or die('<div class="error-response sql-import-response">Problem in executing the SQL query <b>' . $query. '</b></div>'); header('Location:../pages/importDb.php?error=1');
                        $query= '';		
                    }
                }
                echo '<div class="success-response sql-import-response">SQL file imported successfully</div>';
                unlink($target_file);
                header('Location:../pages/importDb.php?success=1');
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }
}
