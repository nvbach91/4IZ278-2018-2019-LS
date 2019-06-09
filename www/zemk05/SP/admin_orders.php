<?php 
require 'db.php';
require 'admin_req.php';

$messages = [];
$errors = [];
if(isset($_GET['cart_items_id'])){
  $items = $cartItemsDB->getPDO()->prepare("SELECT cart_items_eshop.*, products_eshop.* FROM cart_items_eshop left join products_eshop on cart_items_eshop.product_id=products_eshop.products_id where orders_id=:item");
$items->execute([
        'item'=>$_GET['cart_items_id']
        ]);
$items = $items->fetchAll();
}


$orders = $ordersDB->getPDO()->prepare("SELECT orders_eshop.*, users_eshop.email FROM orders_eshop left join users_eshop on orders_eshop.customer=users_eshop.users_id order by order_date desc");    

$orders->execute();
$orders = $orders->fetchAll();
?>



<?php require __DIR__ . '/incl/header.php'; ?>

<main role="main">

<?php require __DIR__ . '/incl/navbar.php'; ?>
    <?php if(count($errors)): ?>
        <div class="alert alert-danger">
                <?php foreach($errors as $error): ?>
                <p><?php echo $error; ?></p>
                <?php endforeach ?>
        </div>
    <?php endif ?>
    <?php if(count($messages)): ?>
        <div class="alert alert-success">
                <?php foreach($messages as $message): ?>
                <p><?php echo $message; ?></p>
                <?php endforeach ?>
        </div>
    <?php endif ?>
<h1>Správa objednávek</h1>
<table class="table table-striped table-bordered table-hover text-center">
  <thead>
    <tr>
      <th scope="col">Číslo objednávky</th>
      <th scope="col">Datum</th>
      <th scope="col">Zákazník</th>
      <th scope="col">Detaily objednávky</th>
      <th scope="col">Zrušit objednávku</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach($orders as $order): ?>
            <tr>
                <td><?php echo @$order['orders_id'];?></td>
                <td><?php $date = strtotime($order['order_date']);
                       echo date('j.n.Y G:i:s', $date);?></td>
                <td><?php echo @$order['email'];?></td>
                <td><a href="./order_detail.php?order_detail=<?php echo @$order['orders_id'];?>" class="btn btn-dark">Detail</a></td>
                <td><a href="./cancel_order.php?orders_id=<?php echo @$order['orders_id'];?>" class="btn btn-dark">Smazat</a></td>
            </tr>
  <?php endforeach; ?>
  </tbody>
</table>

</main>

<?php require __DIR__ . '/incl/footer.php'; ?>