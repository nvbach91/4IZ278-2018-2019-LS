<?php 
require 'db.php';
require 'user_req.php';

if(!isset($_GET['orders_id'])){
    die('Objednávka není');
}
$order_delete = $ordersDB->fetchBy('orders_id', $_GET['orders_id']);
if(!$order_delete){
    die('Objednávka nenalezena');
}

$ordersDB->deleteBy('orders_id', $_GET['orders_id']);
header('Location: admin_orders.php?order&deleted=true');
die();

?>
