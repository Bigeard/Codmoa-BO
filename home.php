<?php
require_once './api/ServicesConnection.php';


require_once './api/ServicesInfo.php';
$service = new ServicesInfo;
// if(isset($_GET['research'])){ $research = $_GET['research'];} else { $research = ''; }
$result = $service->getInfoByList();

$nb_elem_page = 6;
$page = isset($_GET['page'])?intval($_GET['page']-1):0;
if (isset($result)){
    $number_of_pages = intval((count($result)-1)/$nb_elem_page)+1;
}
?> 

<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css" />
</head>
<body>

    <div class="content">
            <div class="user">
                <img class="user-img" src="./img/users_img/img_default.svg" alt="<?= $_SESSION['user_firstname'] ?> image">
                <a href="./user.php">
                    <h2><?= $_SESSION['user_firstname'] ?> <?= $_SESSION['user_lastname'] ?></h2>

                    <?php if($_SESSION['user_hierarchy']==="admin" || $_SESSION['user_hierarchy']==="write") { ?>
                            <a class="add" href="info.php">Add information</a>
                    <?php } ?>
                </a>
            </div>



        <?php if ($result){ foreach (array_slice($result, $page*$nb_elem_page, $nb_elem_page) as $info): ?>
            <div class="info">
                <h2><?= $info['info_title']?></h2>
                <h3><?= $info['info_subtitle']?></h3>
                <p><?= $info['info_text']?></p>
                <p><?= $info['info_autor']?></p>
                <?php if($_SESSION['user_hierarchy']==="admin" || $_SESSION['user_id'] === $info['info_autor']) { ?>
                    <a href="info.php?info_id=<?= $info['info_id']?>">Edit</a>
                <?php } ?>
            </div>
        <?php endforeach; } ?>

        
        <?php if (isset($result) && $number_of_pages != 1){ ?>
            <div class="page">
                <?php for($i = 1; $i <= $number_of_pages; $i++):?>
                        <a class="page-link" href='home.php?page=<?= $i ?>'><?= $i ?></a>
                <?php endfor; ?>
            </div>
        <?php } ?>
    </div>
    
</body>
</html>