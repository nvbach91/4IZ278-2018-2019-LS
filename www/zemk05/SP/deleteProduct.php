<?php
require_once __DIR__ . './ProductsDB.php'; 
$productsDB = new ProductsDB('products_eshop');

$del_product = $_GET['id'];

if(!$del_product){
    die("ID produktu chybí!");
}

$productsDB->deleteBy('products_id', $del_product);
header('Location: index.php?delete=true');
die();
?>