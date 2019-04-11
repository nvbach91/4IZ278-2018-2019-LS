<?php
require './admin_required.php';
require './Header.php';
require  './Navbar.php';
require_once './ProductsDB.php';

$db = new ProductsDB();

if (! empty($_GET)) {
    $id=$_GET['id'];
    $privilege = $_GET['priv'];
    $db->setUserPrivilege($id,$privilege);

}


$users = $db ->fetchAllUsers();
foreach ($users as $user){
    if ($user['privilege']==3):?>
        Admin: <?=$user['email']?>
        <a class = "btn btn-primary" href="./users.php?id=<?=$user['id']?>&priv=1">Set User</a>
        <a class = "btn btn-primary" href="./users.php?id=<?=$user['id']?>&priv=2">Set Manager</a>
        <a class = "btn btn-primary" href="./users.php?id=<?=$user['id']?>&priv=3">Set Admin</a><br>
    <?php elseif ($user['privilege']==2):?>
        Manager: <?=$user['email']?>
        <a class = "btn btn-primary" href="./users.php?id=<?=$user['id']?>&priv=1">Set User</a>
        <a class = "btn btn-primary" href="./users.php?id=<?=$user['id']?>&priv=2">Set Manager</a>
        <a class = "btn btn-primary" href="./users.php?id=<?=$user['id']?>&priv=3">Set Admin</a><br>
    <?php else: ?>
        User: <?=$user['email']?>
        <a class = "btn btn-primary" href="./users.php?id=<?=$user['id']?>&priv=1">Set User</a>
        <a class = "btn btn-primary" href="./users.php?id=<?=$user['id']?>&priv=2">Set Manager</a>
        <a class = "btn btn-primary" href="./users.php?id=<?=$user['id']?>&priv=3">Set Admin</a><br>
    <?php endif;

}




require './Footer.php';