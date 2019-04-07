<?php
require 'db.php';
require 'manager_require.php';

$productToDelete = $_GET['id'];
$goodsDB->delete('id', $productToDelete);

header('Location: index.php?delete');
die();

?>