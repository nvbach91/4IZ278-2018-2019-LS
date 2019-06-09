<?php
session_start();

require_once './ProductsDB.php';

$product_rem = @$_POST['id'];

foreach ($_SESSION['cart'] as $key => $value){
    if ($value == $product_rem) {
        unset($_SESSION['cart'][$key]);
    }
}
header('Location: cart.php');
die();
?>