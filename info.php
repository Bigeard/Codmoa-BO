<?php
require_once './api/ServicesConnection.php';


require_once './api/ServicesInfo.php';
$redirect = "";
if(isset($_GET['info'])){$info = $_GET['info'];} else {$info = 0;}
if(isset($_GET['info_id'])){
  $submit = "edit";
  $redirect = "&info_id=" . $_GET['info_id'];
  $service = new ServicesInfo;
  $info = $service->getInfoById($_GET['info_id']);

  if($_SESSION['user_id']!=$info['info_autor'] && $_SESSION['user_hierarchy']!="admin" ) {
    header('Location: ./home.php');
  }

  if(isset($_GET['delete'])) {
    header('Location: ./api/ServicesInfo.php?info_id=' . $_GET['info_id'] . '&delete');
  }
} else {
  $submit = "add";
}



?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Add information</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css" />    
  </head>
  <body>
    <div class="content con">
        <h2>Add information</h2>
        <form action="api/ServicesInfo.php?info_autor=<?= $_SESSION['user_id'] ?><?= $redirect ?>" method="post">

          <label for="info_title">Title</label>
          <input id="info_title" name="info_title" type="text" placeholder="Enter your title" value="<?= $info['info_title'] ?>">

          <label for="info_subtitle">Subtitle</label>
          <input id="info_subtitle" name="info_subtitle" type="text" placeholder="Enter your subtitle" value="<?= $info['info_subtitle'] ?>">

          <label for="info_text">Text</label>
          <textarea id="info_text" name="info_text" placeholder="Enter your text" rows="8"><?= $info['info_text'] ?></textarea> 

          <button name="<?= $submit ?>" type="submit">Comfirm</button>
        </form>
        <a href="home.php">Return</a>
        <?php if(isset($_GET['info_id'])){ ?>
          <a href="info.php?info_id=<?= $_GET['info_id'] ?>&delete">Delete</a>
        <?php } ?>

          <?php 
            if($info == 1){echo "<p class=\"info\">Error: information exist.</p>";}
            if($info == 2){echo "<p class=\"info\">Error: fill all input.</p>";}
            ?>
    </div>
  </body>
</html>
