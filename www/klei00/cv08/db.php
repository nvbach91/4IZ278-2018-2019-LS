<?php
require __DIR__.'/database/GoodsDB.php';
require __DIR__.'/database/UsersDB.php';

$goodsDB = new GoodsDB('goods');
$usersDB = new UsersDB('users');

?>