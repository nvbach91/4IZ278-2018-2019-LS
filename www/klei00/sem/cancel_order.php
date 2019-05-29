<?php

require 'db.php';
require 'user_require.php';

if(!isset($_GET['order'])){
    die('Objednávka nenalezena');
}
$orderToCancel = $ordersDB->fetch('order_number', $_GET['order']);
if(!$orderToCancel){
    die('Objednávka nenalezena');
}
if((int)$orderToCancel[0]['status']===2){
    header('Location: profile.php?orders&canceled=false');
    die();
}
$ordersDB->delete('order_number', $_GET['order']);

header('Location: profile.php?orders&canceled=true');
die();

?>