<?php
require 'db.php';
require 'user_req.php';

$productsInCart = @$_SESSION['cart'];
$question_marks = str_repeat('?,', count($productsInCart) - 1) . '?';

$stmt = $productsDB->getPDO()->prepare("SELECT * FROM products_eshop WHERE products_id IN ($question_marks) ORDER BY name");
$stmt->execute(array_keys($productsInCart));
$Products = $stmt->fetchAll();

$customer = $logged_user[0]['users_id'];
$ordersDB->create($customer);
$order_id = $ordersDB->getPDO()->lastInsertId();

foreach($Products as $Product){
    $cartItemsDB->create(['orders_id'=>$order_id, 'product_id'=>$Product['products_id'], 'price'=>$Product['price'], 'quantity'=>$productsInCart[$Product['products_id']]]);
}

$stmt = $cartItemsDB->getPDO()->prepare('SELECT sum(price*quantity) total_price FROM cart_items_eshop WHERE orders_id=:orders_id');
$stmt->execute([
    'orders_id'=>$order_id
]);
$total_price = $stmt->fetchColumn();

if(isset($total_price)){
    $ordersDB->updateBy(['orders_id'=>$order_id], ['total_price'=>$total_price]);
    unset($_SESSION['cart']);
    header('Location: email.php?recipient='.$_SESSION['email'].'&email=Objednavka');
    die();
}else{
    die('Chyba');
}
?>