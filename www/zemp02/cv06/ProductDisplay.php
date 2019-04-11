
<?php require_once './ProductsDB.php'; ?>
<?php

 $products = [
   ['name' => 'Stop, Friendly Fire!', 'price' => 99.99, 'img' => 'https://cdn.novelupdates.com/images/2018/09/sff.jpg'],
   ['name' => 'Talisman Emperor', 'price' => 99.99, 'img' => 'https://cdn.novelupdates.com/images/2015/09/tailsmanemperor.jpg'],
   ['name' => 'City of Sin', 'price' => 99.99, 'img' => 'https://cdn.novelupdates.com/images/2015/11/sincity.jpg'],
   ['name' => 'Lord of All Realms', 'price' => 99.99, 'img' => 'https://cdn.novelupdates.com/images/2016/06/King-of-Myriad-Domain-1.jpg'],
   ['name' => 'The Charm of Soul Pets', 'price' => 99.99, 'img' => 'https://cdn.novelupdates.com/images/2016/08/The-Charm-of-Soul-Pets-1.jpg'],
   ['name' => 'Against the Gods', 'price' => 99.99, 'img' => 'https://cdn.novelupdates.com/images/2016/06/1416425191645.jpg'],
 ];
$productsDB = new ProductsDB();
//$products = $productsDB->insertTableProduct();
$products = $productsDB->fetchAll('products');

?>

<div class="row">
    <?php foreach($products as $product): ?>
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100 product">
                <a href="#"><img class="card-img-top product-image" src="<?php echo $product['img']; ?>" alt="Just-A-Book"></a>
                <div class="card-body">
                    <h4 class="card-title"><a href="#"><?php echo $product['name']; ?></a></h4>
                    <h5><?php echo number_format($product['price'], 2), ' ', 'Kč'; ?></h5>
                    <p class="card-text">...</p>
                </div>
                <div class="card-footer">
                    <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>