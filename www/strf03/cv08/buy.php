<?php
session_start();
require 'db.php';
require 'user_required.php';

if(!isset($_SESSION['cart'])){

    $_SESSION['cart'] = [];
}

$sql = "SELECT * FROM goods WHERE id = :id";
$stmt = $db->prepare($sql);
$stmt->execute(['id' => $_GET['id']]);
$goods = $stmt->fetch();
if(!$goods){
    die("Unable to find goods!");
}

$_SESSION['cart'][] = $goods["id"];
header('Location: cart.php');
die();
