<?php

session_start();

require 'db.php';

if(!isset($_COOKIE['name'])){
    header('Location: login.php?need_login=true');
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