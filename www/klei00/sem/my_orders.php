<?php
if(isset($_GET['canceled'])){
    $result = $_GET['canceled'];
    if(($result == "true")){
        array_push($messages, 'Objednávka byla úspěšně zrušena');
    }else{
        array_push($errors, 'Objednávka nelze zrušit, protože již byla potvrzena');
    }    
}
$statement = $ordersDB->getPDO()->prepare("SELECT * FROM orders WHERE customer=:customer ORDER BY order_date desc");
$statement->execute([
    'customer'=>$currentUser[0]['user_id']
]);
$orders = $statement->fetchAll();
?>
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
<h2>Objednávky</h2>
<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Datum</th>
            <th scope="col">Cena</th>
            <th scope="col">Stav</th>
            <th scope="col"></th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($orders as $order): ?>
        <tr>
            <td><?php echo @$order['order_number'];?></td>
            <td><?php $date = strtotime($order['order_date']);
                       echo date('j.n.Y G:i:s', $date);?></td>
            <td><?php echo @$order['total_price'].' Kč';?></td>
            <td><?php echo (int)$order['status']===1?'Nepotvrzená':'Potvrzená';?></td>
            <td><a href="profile.php?order_detail=<?php echo @$order['order_number'];?>" class="btn btn-dark">Detail objednávky</a></td>
            <td>
                <?php if((int)$order['status']===1){?>
                    <a href="cancel_order.php?order=<?php echo @$order['order_number'];?>" class="btn btn-dark">Zrušit objednávku</a>
                <?php } ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>