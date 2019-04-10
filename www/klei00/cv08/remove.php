<?php
session_start();
require 'user_require.php';

$productToRemove = @$_POST['id'];

foreach ($_SESSION['cart'] as $key => $value){
    if ($value == $productToRemove) {
        unset($_SESSION['cart'][$key]);
    }
}
header('Location: cart.php');
die();
?>