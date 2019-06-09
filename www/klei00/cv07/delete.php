<?php
require 'db.php';

$productToDelete = $_GET['id'];
if(!$productToDelete){
    die("ID of a product is missing!");
}
$goodsDB->delete('id', $productToDelete);

header('Location: index.php?delete=true');
die();

?>