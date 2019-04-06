<?php
session_start();
if(!isset($_SESSION["username"]) && !isset($_SESSION["password"])) header('Location: ../../index.php?error=2');
$path = "http://localhost/Codmoa-BO/styles/main.css";
// echo $path;
?>

<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Codmoa</title>
    <script src="../js/konami.js"></script>
    <link rel="stylesheet" type="text/css" href="<?= $path ?>" />
</head>

<body>
    <a href="http://localhost/Codmoa-BO/library/disconnect.php" class="disconnect">Disconnect</a>