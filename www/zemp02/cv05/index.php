<?php
require './DatabaseOperations.php';
require  './header.php';


echo '<pre>';

$users = new UsersDB();
$users->create(['name'=>'Soudruh','age'=>99]);
$users->create(['name' => 'Kolega', 'age' => 69]);
$users->create(['name' => 'Karel', 'age' => 19]);
$users->fetch();
$users->save();
$users->delete();
echo PHP_EOL;

$products = new ProductsDB();
$products->create(['name' => 'Černý rytíř', 'price' => 699]);
$products->create(['name' => 'Rytíř NI', 'price' => -4]);
$products ->fetch();
$products->delete();
echo PHP_EOL;

$orders = new OrdersDB();
echo $orders, PHP_EOL;
$orders->create(['number' => 31, 'date' => '2018-16-12']);
$orders->fetch();
$orders->save();
$orders->delete();


require './footer.php';