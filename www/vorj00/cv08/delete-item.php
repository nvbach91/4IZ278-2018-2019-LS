<?php
require __DIR__ . '/db/GoodsDB.php';

session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: signin.php');
    die();
}

$goodsDB = new GoodsDB();
$goodsItem = $goodsDB->getGoodsItem($_GET['id']);

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if (!$goodsItem){
    die("Unable to find goods!");
}

$goodsDB->delete($_GET['id']);

header('Location: index.php');
die();
?>