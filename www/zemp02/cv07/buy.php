<?php
if (empty($_GET['id'])) {
    header('Location: index.php');
    die();
} else {
    session_start();
    require_once './ProductsDB.php';
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    $productsDB = new ProductsDB();
    if ($_GET['id'] >= $productsDB->listSize()+1) {
        die("Unknown good.");
    }
    $_SESSION['cart'][] = $_GET['id'];
header('Location: index.php');
die();
}
?>