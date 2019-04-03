<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Log In</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="./styles/main.css" />
    <!--<script src="main.js"></script>-->
</head>

<body>
    <h1>Log In to Database</h1>
    <form action="library/checkLogin.php" method="POST">
        <input type="text" id="username" name="username" placeholder="Username" required>
        <input type="password" id="password" name="password" placeholder="Password" required>
        <input type="submit" value="Send">
    </form>
    
    <?php if(isset($_GET['error'])) { ?>
        <?php if($_GET['error'] == 1) : ?>
            <p>Login or Password incorrect</p>
        <?php elseif($_GET['error'] == 2) : ?>
            <p>Session expired, please reconnect</p>
        <?php elseif($_GET['error'] == 3) : ?>
            <p>User not allowed to connect</p>
        <?php else : ?>
            
        <?php endif; ?>
    <?php } ?>
    
    
</body>

</html>