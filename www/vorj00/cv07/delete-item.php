<?php
require __DIR__ . '/db/GoodsDB.php';
$goodsDB = new GoodsDB();
$goodsItem = $goodsDB->getGoodsItem($_GET['id']);

session_start();
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