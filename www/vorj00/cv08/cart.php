<?php include './incl/header.php' ?>
<?php

require __DIR__ . '/db/GoodsDB.php';
$goodsDB = new GoodsDB();

$ids = @$_SESSION['cart'];
if (is_array($ids) && count($ids)) {
    $goods = $goodsDB->getCart($ids);
    $goodsPrice = $goodsDB->getCartPrice($ids);
}
?>



<?php include './incl/nav.php' ?>
<main class="container">
    <h1>My shopping cart</h1>
    Total goods selected: <?= @count($goods) ?>
    <br/><br/>
    <a href="index.php">Back to the mangos!</a>
    <br/><br/>
    <?php if(@$goods): ?>
    <div class="products">
        <?php foreach($goods as $row): ?>
        <div class="card product" style="width: calc(100% / 3)">
            <div class="card-body">
                <h5 class="card-title"><?php echo $row['name'] ?></h5>
                <div class="card-subtitle"><?php echo $row['price'] ?></div>
                <div class="card-text"><?php echo $row['description'] ?></div>
                <!-- <form action="remove-item.php" method="POST">
                    <input class="d-none" name="id" value="<?php /*echo $row['id']*/ ?>">
                    <button type="submit" class="btn btn-danger">Remove</button>
                </form> -->
                <a href="./remove-item.php?id=<?php echo $row['id'] ?>" class="btn btn-danger">Remove</a>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <?php else: ?>
    <h5>No goods yet</h5>
    <?php endif; ?>
</main>
<?php require './incl/footer.php'; ?>