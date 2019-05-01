<?php
require 'db.php';
require 'user_require.php';

$productToRemove = @$_POST['bookToRemove'];

foreach ($_SESSION['cart'] as $key => $value){
    if ($value == $productToRemove) {
        unset($_SESSION['cart'][$key]);
    }
}
header('Location: cart.php');
die();
?>