<?php
session_start();
$id = @$_GET['id'];
foreach ($_SESSION['cart'] as $key => $value){
    //echo $value.'|'.$id.'||';
    if ($value == $id) {
        unset($_SESSION['cart'][$key]);
    }
}
//var_dump($_SESSION['cart']);
header('Location: cart.php');
die();
?>