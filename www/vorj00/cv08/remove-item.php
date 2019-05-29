<?php
session_start();
$id = @$_GET['id'];
#var_dump($_SESSION['cart']);
foreach ($_SESSION['cart'] as $key => $value){
    if ($value == $id) {
        unset($_SESSION['cart'][$key]);
        echo "yes";
    }
}
header('Location: cart.php');
die();
?>