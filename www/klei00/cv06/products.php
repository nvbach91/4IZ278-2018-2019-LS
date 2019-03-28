<?php require __DIR__.'/database/ProductsDB.php'; ?>

<?php

$productsDB = new ProductsDB('products');
$products = $productsDB->fetchAll();

?>

<div class="row">
<?php foreach($products as $product): ?>
    <div class="col-lg-4 col-md-6 mb-4">
    <div class="card h-100">
        <a href="#"><img class="card-img-top" src="<?php echo $product['img'] ?>" alt=""></a>
        <div class="card-body">
        <h4 class="card-title">
            <a href="#"><?php echo $product['name'] ?></a>
        </h4>
        <h5><?php echo $product['price'] ?> Kč</h5>
        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur!</p>
        </div>
        <div class="card-footer">
        <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
        </div>
    </div>
    </div>
<?php endforeach; ?>

</div>