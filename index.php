<?php
if(isset($_COOKIE['user_email']) && isset($_COOKIE['user_password']) || isset($_SESSION['user_email']) && isset($_SESSION['user_password'])) {header('Location: connect');}
if(isset($_GET['info'])){$info = $_GET['info'];} else {$info = 0;}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Log in</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css" />    
  </head>
  <body>

      <div class="content con">
        <h1>Codmoa</h1>
        <h2>Log in</h2>

        <form action="api/checkLogin.php" method="post">
          <label for="user_name">Identifiant</label>
          <input id="user_name" name="user_name" type="text" placeholder="Enter your name">
          <label for="user_password">Password</label>
          <input id="user_password" name="user_password" type="password" placeholder="Enter your password">
          <button name="login" type="submit">Log in</button>
        </form>

        <a href="signup.php">Sign up</a>

        <?php 
          if($info == 1){echo "<p class=\"info\">Error: Can not connect</p>";}
          if($info == 2){echo "<p class=\"info\">Deconexion success.</p>";}
          if($info == 3){echo "<p class=\"info\">Sign up success.</p>";}
        ?>

        </div>
  </body>
</html>
