<?php

require 'db.php';
require 'user_require.php';

if(!isset($_SESSION['userID'])){
    header('Location: login.php');
    die();
}

if(!isset($_SESSION['cart'])){
    $_SESSION['cart']=[];
}

$sql = "SELECT * FROM books WHERE book_code = :book_code";
$statement = $booksDB->getPDO()->prepare($sql);
$statement->execute(['book_code' => $_GET['book']]);
$books = $statement->fetch();
if (!$books){
    die("Kniha nenalezena!");
}
$_SESSION['cart'][] = $books['book_code'];
header('Location: cart.php');
die();

?>