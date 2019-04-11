<?php require_once './ProductsDB.php'; ?>
<?php
if (isset($_GET['offset'])) {

    $offset = (int)$_GET['offset'];

} else {

    $offset = 0;
}

$productsDB = new ProductsDB();
$products = $productsDB->fetchPage($offset);
$pageCount = $productsDB->numberOfPages();
?>


<div class="row mt-4">
    <?php foreach ($products as $product): ?>
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-10 product">
                <a href="#"><img class="card-img-top product-image" src="<?php echo $product['img']; ?>"
                                 alt="Just-A-Book"></a>
                <div class="card-body">
                    <h4 class="card-title"><a href="#"><?php echo $product['name']; ?></a></h4>
                    <h5><?php echo number_format($product['price'], 2), ' ', 'Kč'; ?></h5>
                    <p class="card-text"><?php echo $product['description']; ?></p>
                    <a class="card-link btn btn-primary" href='buy.php?id=<?php echo $product['id'] ?>'>Buy</a>
                                   </div>
                <div class="card-footer">
                    <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<div class="row center">
    <div class="btn-toolbar center my-2" role="toolbar" aria-label="Toolbar with button groups">
        <div class="btn-group mr-2" role="group" aria-label="First group">
            <div class="pagination">
                <?php for ($i = 1; $i <= $pageCount; $i++) { ?>
                    <a type="button" class="btn <?= $offset + 1 == $i ? "active" : "" ?>"
                       href="http://localhost/cv07/?offset=<?= $i - 1 ?>"><?= $i ?></a>

                <?php } ?>
            </div>
        </div>
    </div>
