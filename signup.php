<?php
if(isset($_COOKIE['user_email']) && isset($_COOKIE['user_password']) || isset($_SESSION['user_email']) && isset($_SESSION['user_password'])) {header('Location: connect');}
if(isset($_GET['info'])){$info = $_GET['info'];} else {$info = 0;}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Sign up</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css" />    
  </head>
  <body>
    <div class="content con">
        <h1>Codmoa</h1>
        <h2>Sign up</h2>
        <form action="api/ServicesUser.php" method="post">

          <label for="user_firstname">Firstname</label>
          <input id="user_firstname" name="user_firstname" type="text" placeholder="Enter your firstname">

          <label for="user_lastname">Lastname</label>
          <input id="user_lastname" name="user_lastname" type="text" placeholder="Enter your lastname">

          <label for="user_email">Email</label>
          <input id="user_email" name="user_email" type="email" placeholder="Enter your email">

          <label for="user_password">Password</label>
          <input id="user_password" name="user_password" type="password" placeholder="Enter your password">

          <button name="signup" type="submit">Sign up</button>
        </form>
        <a href="index.php">Log in</a>
          <?php 
            if($info == 1){echo "<p class=\"info\">Error: user exist.</p>";}
            if($info == 2){echo "<p class=\"info\">Error: fill all input.</p>";}
            ?>
      </div>
  </body>
</html>
