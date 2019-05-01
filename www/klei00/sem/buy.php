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
$bookToBuy = $books['book_code'];
$piecesInCart = 1;

if(isset($_POST['add'])){
    $piecesInCart+=(int)$_SESSION['cart'][$bookToBuy];
}else if(isset($_POST['remove'])){
    $piecesInCart=(int)$_SESSION['cart'][$bookToBuy]-1;
}else{
    if(array_key_exists($bookToBuy, $_SESSION['cart'])){
        $piecesInCart+=(int)$_SESSION['cart'][$bookToBuy];
    }
}
if($piecesInCart > (int)$books['in_stock']){
    header('Location: cart.php?capacity='.$bookToBuy);
    die();
}
$_SESSION['cart'][$bookToBuy] = $piecesInCart;
header('Location: cart.php');
die();

?>