<?php

require 'db.php';
require 'user_require.php';

if(!isset($_SESSION['userID'])){
    header('Location: login.php');
    die();
}

if(!isset($_SESSION['cart'])){
    $_SESSION['cart']=[];
}

$sql = "SELECT * FROM goods WHERE id = :id";
$statement = $goodsDB->getPDO()->prepare($sql);
$statement->execute(['id' => $_GET['id']]);
$goods = $statement->fetch();
if (!$goods){
    die("Unable to find goods!");
}
$_SESSION['cart'][] = $goods["id"];
header('Location: cart.php');
die();

?>