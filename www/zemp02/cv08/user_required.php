<?php
require_once './ProductsDB.php';
session_start();
if (!isset($_SESSION['userID'])) {
    header('Location: login.php');
    die();
}

$db = new ProductsDB();
$current_user = $db->fetchUserByID($_SESSION['userID']);

if (!$current_user) {
    session_destroy();
    header('Location: index.php');
    die();
}