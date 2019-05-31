<?php
if(isset($_GET['order_detail'])){
    $detailedOrder = $_GET['order_detail']; 
}else{
    die('Objednávka nenalezena');
}
$statement = $itemsDB->getPDO()->prepare("SELECT items.*, title FROM items LEFT JOIN books ON items.book=books.book_code WHERE order_number=:order");
$statement->execute([
    'order'=>$detailedOrder
]);
$items = $statement->fetchAll();
$order = $ordersDB->fetch('order_number', $detailedOrder);
?>

<h2>Detail objednávky č. <?php echo $detailedOrder;?></h2>
<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">Kniha</th>
            <th scope="col">Počet kusů</th>
            <th scope="col">Jednotková cena</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($items as $item): ?>
        <tr>
            <td><?php echo @$item['title'];?></td>
            <td><?php echo @$item['quantity'];?></td>
            <td><?php echo @$item['unit_price'].' Kč';?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<p class="font-weight-bold">Celková cena: <?php echo @$order[0]['total_price']. ' Kč'; ?></p>