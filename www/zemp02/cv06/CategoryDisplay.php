<?php
require_once './ProductsDB.php';

$productsDB = new ProductsDB();
//$products = $productsDB->insertTableCategory();
$products = $productsDB->fetchAll('categories');



?>

<div class="col-lg-3">

    <h1 class="my-4">Shop Name</h1>
    <div class="list-group">

        <?php foreach ($products as $product):?>
        <a href="#" class="list-group-item"><?php echo '('.$product['number'].') '.$product['name'] ?></a>
        <?php endforeach; ?>
    </div>

</div>
<!-- /.col-lg-3 -->