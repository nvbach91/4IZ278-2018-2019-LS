<?php
require __DIR__.'/database/BooksDB.php';
require __DIR__.'/database/UsersDB.php';
require __DIR__.'/database/GenresDB.php';
require __DIR__.'/database/OrdersDB.php';
require __DIR__.'/database/ItemsDB.php';

$booksDB = new BooksDB('books');
$usersDB = new UsersDB('users');
$genresDB = new GenresDB('genres');
$ordersDB = new OrdersDB('orders');
$itemsDB = new ItemsDB('items');

?>