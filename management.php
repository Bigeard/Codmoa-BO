<?php
require_once './api/ServicesConnection.php';


require_once './api/ServicesUser.php';
$service = new ServicesUser;
// if(isset($_GET['research'])){ $research = $_GET['research'];} else { $research = ''; }
$result = $service->getUserByList();

$nb_elem_page = 6;
$page = isset($_GET['page'])?intval($_GET['page']-1):0;
if (isset($result)){
    $number_of_pages = intval((count($result)-1)/$nb_elem_page)+1;
}
?> 

<!DOCTYPE html>
<html>
<head>
    <title>Attribution Management</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css" />
</head>
<body>

    <div class="content">
        <table>
            <tr>
                <th>Firstname</th>
                <th>Lastname</th>
                <th>Email</th>
                <th>Hierarchy</th>
            </tr> 
            <?php if ($result){ foreach (array_slice($result, $page*$nb_elem_page, $nb_elem_page) as $user): ?>
                <tr>
                    <td><?= $user['user_firstname']?></td>
                    <td><?= $user['user_lastname']?></td>
                    <td><?= $user['user_email']?></td>
                    <td><?= $user['user_hierarchy']?></td>
                </tr>
                    <h2></h2>
            <?php endforeach; } ?>
        </table>

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