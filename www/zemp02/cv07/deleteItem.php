<?php

require_once './ProductsDB.php';
$productsDB = new ProductsDB();
if(empty($_POST)){
    header('Location: goodsSetting.php');
    die();
}
if (!empty($_POST['id'])) {

    $id = $_POST['id'];
    $products = $productsDB->deleteGood($id);
    header('Location: goodsSetting.php');
    die();
}