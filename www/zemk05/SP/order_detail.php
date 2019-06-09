<?php

require 'db.php';
require 'user_req.php';

$logged_user  = $usersDB->fetchBy('users_id',$_SESSION['id']);
if($logged_user){
  $privilege = (int)$logged_user[0]['privilege'];
}

if(isset($_GET['order_detail'])){
    $OrderDetail = $_GET['order_detail']; 
}else{
    die('Objednávka nenalezena');
}

$stmt = $cartItemsDB->getPDO()->prepare("SELECT cart_items_eshop.*, products_eshop.name FROM cart_items_eshop JOIN products_eshop ON cart_items_eshop.product_id=products_eshop.products_id WHERE orders_id=:order");
$stmt->execute([
    'order'=>$OrderDetail
]);
$itemsOrder = $stmt->fetchAll();

$order = $ordersDB->fetchBy('orders_id', $OrderDetail);
?>

<?php require __DIR__ . '/incl/header.php'; ?>

<main role="main">

<?php require __DIR__ . '/incl/navbar.php'; ?>
<h2>Detail objednávky č. <?php echo $OrderDetail;?></h2>
<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">Produkt</th>
            <th scope="col">Počet kusů</th>
            <th scope="col">Cena/ks</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($itemsOrder as $item): ?>
        <tr>
            <td><?php echo @$item['name'];?></td>
            <td><?php echo @$item['quantity'];?></td>
            <td><?php echo @$item['price'],' ', GLOBAL_CURRENCY;?>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<p class="font-weight-bold">Celková cena: <?php echo @$order[0]['total_price'],' ', GLOBAL_CURRENCY ?></p> 
<?php if($privilege == 1): ?>
  <a href="user_orders.php" class="btn btn-dark">Zpět k přehledu objednávek</a>
<?php endif; ?>
<?php if($privilege > 1): ?>
  <a href="admin_orders.php" class="btn btn-dark">Zpět ke správě objednávek</a>
<?php endif; ?>
</main>

<?php require __DIR__ . '/incl/footer.php'; ?>