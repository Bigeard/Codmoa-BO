<?php
require_once 'ConnectionMethods.php';

class ServicesInfo extends ConnectionMethods {

    public function getInfoByList()
    {
        $this->startConnection($_SESSION["username"], $_SESSION["password"]);

        $sql = "SELECT * FROM table_info ORDER BY info_id DESC";
        $req = $this->connection->prepare($sql);
        $req->execute();

        $result = $req->fetchAll(PDO::FETCH_ASSOC);
        $this->endConnection();

        $result = count($result) > 0 ? $result : null; 

        return $result;
    }

    public function getInfoById($id)
    {
        $this->startConnection($_SESSION["username"], $_SESSION["password"]);
        $sql = 'SELECT * FROM table_info WHERE info_id = :id ';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->endConnection();

        $result = count($result) > 0 ? $result : null; 

        return $result;

    }

    public function addInfo($info_autor, $info_title, $info_subtitle, $info_text)
    {
        $this->startConnection($_SESSION["username"], $_SESSION["password"]);

        //------------------------ Detect info exist --------------------------------

        $sql="SELECT info_title, info_subtitle, info_text
        FROM table_info 
        WHERE info_title = :info_title
        AND info_subtitle = :info_subtitle
        OR info_text = :info_text";
        $req = $this->connection->prepare($sql);
        $req->bindParam(':info_title', $info_title);
        $req->bindParam(':info_subtitle', $info_subtitle);
        $req->bindParam(':info_text', $info_text);
        $req->execute();
        $exist = $req->fetch();
        
        //------------------------ Create info --------------------------------

        if(!isset($exist['info_title']) || !isset($exist['info_subtitle']) || !isset($exist['info_text'])) {
            var_dump($info_id);
            $sql="INSERT INTO table_info
            (info_autor, info_title, info_subtitle, info_text)
            VALUES (:info_autor, :info_title, :info_subtitle, :info_text)";
            $req = $this->connection->prepare($sql);
            $req->bindParam(':info_autor', $info_autor);
            $req->bindParam(':info_title', $info_title);
            $req->bindParam(':info_subtitle', $info_subtitle);
            $req->bindParam(':info_text', $info_text);
            $req->execute();
            $result = true;
        } else {
            $result = false;
        }
        $this->endConnection();
        return $result;
    }

    public function editInfo($info_autor, $info_title, $info_subtitle, $info_text, $info_id)
    {
        $this->startConnection($_SESSION["username"], $_SESSION["password"]);

        //------------------------ Detect info exist --------------------------------

        $sql="SELECT info_title, info_subtitle, info_text
        FROM table_info 
        WHERE info_title = :info_title
        AND info_subtitle = :info_subtitle AND info_id != :info_id
        OR info_text = :info_text AND info_id != :info_id";
        $req = $this->connection->prepare($sql);
        $req->bindParam(':info_title', $info_title);
        $req->bindParam(':info_subtitle', $info_subtitle);
        $req->bindParam(':info_text', $info_text);
        $req->bindParam(':info_id', $info_id);
        $req->execute();
        $exist = $req->fetch();
        
        //------------------------ Create info --------------------------------

        if(!isset($exist['info_title']) || !isset($exist['info_subtitle']) || !isset($exist['info_text'])) {
            $sql="UPDATE table_info SET
            info_autor = :info_autor, info_title = :info_title, info_subtitle = :info_subtitle, info_text = :info_text 
            WHERE info_id = :info_id";
            $req = $this->connection->prepare($sql);
            $req->bindParam(':info_autor', $info_autor);
            $req->bindParam(':info_title', $info_title);
            $req->bindParam(':info_subtitle', $info_subtitle);
            $req->bindParam(':info_text', $info_text);
            $req->bindParam(':info_id', $info_id);
            $req->execute();
            $result = true;
        } else {
            $result = false;
        }
        $this->endConnection();
        return $result;
    }

    public function deleteInfo($info_id){
        $this->startConnection($_SESSION["username"], $_SESSION["password"]);
        $sql = 'DELETE FROM table_info WHERE info_id  = ?';
        $req = $this->connection->prepare($sql);
        $req->execute([$info_id]);
        $this->endConnection();
    }
    
}

$service = new ServicesInfo;

if(isset($_POST['info_title']) && isset($_POST['info_subtitle']) && isset($_POST['info_text']) && $_SERVER['REQUEST_METHOD'] === 'POST') {

    if(isset($_POST['add'])){
        $result = $service->addInfo($_GET['info_autor'], $_POST['info_title'], $_POST['info_subtitle'], $_POST['info_text']);
    } 
    
    if(isset($_POST['edit'])) {
        $result = $service->editInfo($_GET['info_autor'], $_POST['info_title'], $_POST['info_subtitle'], $_POST['info_text'], $_GET['info_id']);
    }

    if($result) {
        header('Location: ../home.php?info=3');
    } else {
        header('Location: ../info.php?info=1');
    }
}

if(isset($_GET['info_id']) && isset($_GET['delete'])) {
    $result = $service->deleteInfo($_GET['info_id']);
    header('Location: ../home.php');
}