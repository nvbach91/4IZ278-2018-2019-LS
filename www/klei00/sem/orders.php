<?php
require 'db.php';
require 'manager_require.php';

$messages = [];
$errors = [];

if(isset($_GET['id'])){
    $orderToSubmit = $ordersDB->fetch('order_number', $_GET['id']);
    if((int)$orderToSubmit[0]['status']===2){
        array_push($errors, 'Objednávka již byla vyřízena, aktualizujte stránku');
    }else{
        $items = $itemsDB->getPDO()->prepare("SELECT items.*, books.* FROM items left join books on items.book=books.book_code where order_number=:item");
        $items->execute([
            'item'=>$_GET['id']
        ]);
        $items = $items->fetchAll();
        foreach($items as $item){
            // Control of quantity
            if((int)$item['quantity'] > (int)$item['in_stock']){
                $missing = (int)$item['quantity']-(int)$item['in_stock'];
                array_push($errors, 'Nedostatečné množství knihy <i>'.$item['title'].'</i> na skladě (chybí '.$missing.' ks)');
            }
        }
        // Submit order
        if(!count($errors)){
            foreach($items as $item){
                $newQuantity = (int)$item['in_stock']-(int)$item['quantity'];
                $booksDB->update(['book_code'=>$item['book_code']], ['in_stock'=>$newQuantity]);
            }
            $ordersDB->update(['order_number'=>$orderToSubmit[0]['order_number']], ['status'=>2]);
            array_push($messages, 'Objednávka byla potvrzena');
        }
    }    
}
//show only back orders
if(isset($_GET['status'])){
    $orders = $ordersDB->getPDO()->prepare("SELECT orders.*, concat(users.first_name, ' ', users.surname) as name FROM orders left join users on orders.customer=users.user_id where orders.status=1 order by order_date desc");
}else{
    //show all orders
    $orders = $ordersDB->getPDO()->prepare("SELECT orders.*, concat(users.first_name, ' ', users.surname) as name FROM orders left join users on orders.customer=users.user_id order by order_date desc");    
}
$orders->execute();
$orders = $orders->fetchAll();

?>

<?php require __DIR__.'/components/header.php'; ?>
<main class="container padding">
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
    <br>
    <?php if((int)@$_GET['status']===1){ ?>
        <a class="btn btn-dark" href="orders.php">Všechny objednávky</a>
    <?php }else{ ?>        
        <a class="btn btn-dark" href="orders.php?status=1">Nevyřízené objednávky</a>
    <?php } ?>
    <br><br>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Datum</th>
                <th scope="col">Zákazník</th>                
                <th scope="col">Stav</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($orders as $order): ?>
            <tr>
                <td><?php echo @$order['order_number'];?></td>
                <td><?php $date = strtotime($order['order_date']);
                       echo date('j.n.Y G:i:s', $date);?></td>
                <td><?php echo @$order['name'];?></td>
                <td><?php echo ((int)$order['status']===1)?'Nevyřízená':'Vyřízená';?></td>
                <td><?php if((int)$order['status']===1){ ?>
                    <a href="orders.php?id=<?php echo @$order['order_number'];?>" class="btn btn-dark">Potvrdit</a>
                <?php } ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</main>
<?php require __DIR__.'/components/footer.php'; ?>