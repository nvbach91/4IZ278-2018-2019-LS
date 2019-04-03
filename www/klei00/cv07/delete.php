<?php
require 'db.php';

$productToDelete = $_GET['id'];
$goodsDB->delete('id', $productToDelete);

header('Location: index.php?delete=true');
die();

?>