<?php
require './db.php';
require  './user_req.php';

if(!isset($users_id)){
    header('Location: login.php');
    die();
}

if(!isset($_SESSION['cart'])){
    $_SESSION['cart']=[];
}

$sql = "SELECT * FROM products_eshop WHERE products_id = :products_id";
$statement = $productsDB->getPDO()->prepare($sql);
$statement->execute(['products_id' => $_GET['id']]);
$products = $statement->fetch();


if (!$products){
    die("Produkt nenalezen!");
}

$productToCart = $products['products_id'];
$productCount = 1;

if(isset($_POST['add'])){
    $productCount +=(int)$_SESSION['cart'][$productToCart];
}else if(isset($_POST['remove'])){
    $productCount =(int)$_SESSION['cart'][$productToCart]-1;
}else{
    if(array_key_exists($productToCart, $_SESSION['cart'])){
        $productCount +=(int)$_SESSION['cart'][$productToCart];
    }
}

$_SESSION['cart'][$productToCart] =  $productCount;
header('Location: cart.php');
die();
?>