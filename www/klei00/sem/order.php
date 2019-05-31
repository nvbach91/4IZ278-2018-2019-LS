<?php

require 'db.php';
require 'user_require.php';

$goodsInCart = @$_SESSION['cart'];

$question_marks = str_repeat('?,', count($goodsInCart) - 1) . '?';
    
$statement = $booksDB->getPDO()->prepare("SELECT * FROM books WHERE book_code IN ($question_marks) ORDER BY title");
$statement->execute(array_keys($goodsInCart));
$books = $statement->fetchAll();

//create an order
$customer = $currentUser[0]['user_id'];
$ordersDB->create($customer);
$orderID = $ordersDB->getPDO()->lastInsertId();

//add ordered books
foreach($books as $book){
    $itemsDB->create(['order_number'=>$orderID, 'book'=>$book['book_code'], 'unit_price'=>$book['price'], 'quantity'=>$goodsInCart[$book['book_code']]]);
}
//calculate total price
$statement = $itemsDB->getPDO()->prepare('SELECT sum(unit_price*quantity) total_price FROM items WHERE order_number=:order_id');
$statement->execute([
    'order_id'=>$orderID
]);
$totalPrice = $statement->fetchColumn();
if(isset($totalPrice)){
    $ordersDB->update(['order_number'=>$orderID], ['total_price'=>$totalPrice]);
    unset($_SESSION['cart']);
    header('Location: mail.php?recipient='.$_SESSION['email'].'&mail=Objednavka');
    die();
}else{
    die('Chyba při výpočtu celkové ceny');
}
?>