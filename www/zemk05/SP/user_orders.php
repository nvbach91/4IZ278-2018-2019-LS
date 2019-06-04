<?php 
require 'db.php';
require 'user_req.php';

$errors = [];
$messages = [];

$statement = $ordersDB->getPDO()->prepare("SELECT * FROM orders_eshop WHERE customer=:customer ORDER BY order_date desc");
$statement->execute([
    'customer'=>$logged_user[0]['users_id']
]);
$orders = $statement->fetchAll();

?>



<?php require __DIR__ . '/incl/header.php'; ?>
<?php require __DIR__ . '/incl/navbar.php'; ?>
<main role="main">

<?php if(count($messages)): ?>
    <div class="alert alert-success">
        <?php foreach($messages as $message): ?>
            <p><?php echo $message; ?></p>
        <?php endforeach ?>
    </div>
<?php endif ?>
<?php if(count($errors)): ?>
    <div class="alert alert-danger">
        <?php foreach($errors as $error): ?>
            <p><?php echo $error; ?></p>
        <?php endforeach ?>
    </div>
<?php endif ?>
<h1>Historie objednávek</h1>
<table class="table table-striped table-bordered table-hover text-center">
  <thead>
    <tr>
      <th scope="col">Číslo objednávky</th>
      <th scope="col">Datum</th>
      <th scope="col">Cena</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($orders as $order): ?>
      <tr>
        <td><?php echo @$order['orders_id'];?></td>
        <td><?php $date = strtotime($order['order_date']);
                       echo date('j.n.Y G:i:s', $date);?></td>
        <td><?php echo @$order['total_price'],' ', GLOBAL_CURRENCY;?></td>
        <td><a href="./order_detail.php?order_detail=<?php echo @$order['orders_id'];?>" class="btn btn-dark">Detail objednávky</a></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

</main>

<?php require __DIR__ . '/incl/footer.php';