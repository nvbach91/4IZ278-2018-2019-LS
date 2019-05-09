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

# pridame id zbozi do session pole
# TODO neresime, ze od jednoho zbozi muze byt vetsi mnozstvi nez 1, domaci ukol :)
$_SESSION['cart'][] = $goodsItem["id"];
header('Location: cart.php');
die();
?>