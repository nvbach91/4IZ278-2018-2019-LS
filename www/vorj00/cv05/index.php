<?php require 'db.php';?>
<?php
$usersDB = new UsersDB();
$user = $usersDB->create(['fname' => 'Michael Jackson', 'email' => 'someonecalled@michael.net', 'age' => 9]);
$user = $usersDB->fetch(['email' => 'elena@fisher.org']);
$user = $usersDB->save(['email' => 'new@email.com', 'newEmail' => 'newer@email.com']);
$user = $usersDB->delete(['email' => 'A@A.COM']);
var_dump($user);

$productDB = new ProductsDB();
$product = $productDB->create(['pname' => 'Something', 'price' => 9]);
$product = $productDB->create(['pname' => 'Something Else', 'price' => 999]);
$product = $productDB->fetch(['pname' => 'Something']);
$product = $productDB->save(['pname' => 'Something Else', 'newPrice' => 100]);
$product = $productDB->delete(['pname' => 'Something']);
var_dump($product);

$orderDB = new OrdersDB();
$order = $orderDB->create(['user' => 1, 'product' => 9]);
$order = $orderDB->create(['user' => 3, 'product' => 2]);
$order = $orderDB->fetch(['user' => 3]);
$order = $orderDB->save(['user' => 1, 'product' => 4]);
$order = $orderDB->delete(['user' => 3]);
var_dump($product);
