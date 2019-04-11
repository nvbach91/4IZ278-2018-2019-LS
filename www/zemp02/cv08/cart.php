<?php
require './user_required.php';
require_once 'ProductsDB.php';
$productDB=new ProductsDB();
$ids = @$_SESSION['cart'];
if (is_array($ids) && count($ids)) {

    $products = $productDB->getSpecifiedItems($ids);
    $price = $productDB->getPrice($ids);


}
?>



<?php include './Header.php' ?>
<?php include './Navbar.php' ?>
    <main class="container">
        <h1>My shopping cart</h1>
        Total goods selected: <?= @count($products) ?>
        <br/><br/>
        <a href="index.php">Back to homepage</a>
        <br/><br/>
        <?php if(@$products): ?>
            <div class="row">
                <?php foreach($products as $product): ?>
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card h-10 product">
                            <a href="#"><img class="card-img-top product-image" src="<?php echo $product['img']; ?>"
                                             alt="Just-A-Book"></a>
                            <div class="card-body">
                                <h4 class="card-title"><a href="#"><?php echo $product['name']; ?></a></h4>
                                <h5><?php echo number_format($product['price'], 2), ' ', 'Kč'; ?></h5>
                                <p class="card-text"><?php echo $product['description']; ?></p>
                                <a class="card-link btn btn-primary" href='removeItem.php?id=<?php echo $product['id'] ?>'>Delete</a>
                            </div>
                            <div class="card-footer">
                                <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <h5>No goods yet</h5>
        <?php endif; ?>
    </main>
<?php require './Footer.php'; ?>