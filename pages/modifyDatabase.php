<?php
session_start();
if(!isset($_SESSION["username"]) && !isset($_SESSION["password"])) {
    header('Location: ../index.php?error=2');
}
require "navbar.php";
?> 
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Modify Database</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="../styles/main.css" />
</head>

<body>
    <h1>Modify Database</h1>

    <div class="buttons-wrapper">
        <a href="./createSchema.php"><button>Create Schema</button></a>
        <a href="./removeSchema.php"><button>Remove Schema</button></a>
        <a href="./createTable.php"><button>Create Table</button></a>
        <a href="./removeTable.php"><button>Remove Table</button></a>
    </div>

</body>

</html>