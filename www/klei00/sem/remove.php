<?php
require 'db.php';
require 'user_require.php';

$productToRemove = @$_POST['bookToRemove'];

unset($_SESSION['cart'][$productToRemove]);
header('Location: cart.php');
die();
?>