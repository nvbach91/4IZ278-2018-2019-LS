<?php

require 'db.php';
require 'user_require.php';

$goodsInCart = @$_SESSION['cart'];
if (is_array($goodsInCart) && count($goodsInCart)) {
    $question_marks = str_repeat('?,', count($goodsInCart) - 1) . '?';
    
    $statement = $goodsDB->getPDO()->prepare("SELECT * FROM goods WHERE id IN ($question_marks) ORDER BY name");
    $statement->execute(array_values($goodsInCart));
    $goods = $statement->fetchAll();
    
    $statementSum = $goodsDB->getPDO()->prepare("SELECT SUM(price) FROM goods WHERE id IN ($question_marks)");
    $statementSum->execute(array_values($goodsInCart));
    $sum = $statementSum->fetchColumn();
}
?>

<?php include './components/header.php' ?>
<main class="container">
    <h1>My shopping cart</h1>
    <p>Total goods selected: <?= @count($goods) ?></p>
    <br>
    <a class="btn btn-dark" href="index.php">Back to the mangos!</a>
    <br><br>
    <?php if(@$goods): ?>
    <div class="products">
        <?php foreach($goods as $product): ?>
        <div class="card product" style="width: calc(100% / 3)">
            <img class="card-img-top" src="https://via.placeholder.com/300x150" alt="Card image">
            <div class="card-body">
                <h4 class="card-title"><?php echo $product['name'] ?></h4>
                <div class="card-subtitle"><?php echo $product['price'] ?> Kč</div>
                <div class="card-text"><?php echo $product['description'] ?></div>
                <form action="remove.php" method="POST">
                    <input class="d-none" name="id" value="<?php echo $product['id'] ?>">
                    <button type="submit" class="btn btn-dark">Remove</button>
                </form>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <?php else: ?>
    <h5>No goods yet</h5>
    <?php endif; ?>
</main>
<?php require './components/footer.php'; ?>

?>