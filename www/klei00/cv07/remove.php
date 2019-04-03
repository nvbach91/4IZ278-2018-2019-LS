<?php
session_start();

$productToRemove = @$_POST['id'];
if(!$productToRemove){
    die("ID of a product is missing!");
}

foreach ($_SESSION['cart'] as $key => $value){
    if ($value == $productToRemove) {
        unset($_SESSION['cart'][$key]);
    }
}
header('Location: cart.php');
die();
?>