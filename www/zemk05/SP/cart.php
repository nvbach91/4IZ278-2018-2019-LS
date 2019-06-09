<?php

require './db.php';
require './user_req.php';

$errors = [];
$messages = [];

if(isset($_GET['id'])){
    $Product=$productsDB->fetchBy('products_id',$_GET['id']);

    if(!$Product){
        die('Produkt nebyl nalezen');
    }
}

$productsCart = @$_SESSION['cart'];
$sumPrice = 0;
$sumPieces = 0;

if (is_array($productsCart) && count($productsCart)) {
    foreach($productsCart as $products_id=>$pieces){
        $Product = $productsDB->fetchBy('products_id', $products_id);
        $sumPrice += (int)($Product[0]['price'])*$pieces;
        $sumPieces += $pieces;
    }

    $question_marks = str_repeat('?,', count($productsCart) - 1) . '?';
    
    $stmt = $productsDB->getPDO()->prepare("SELECT * FROM products_eshop WHERE products_id IN ($question_marks) ORDER BY name");
    $stmt->execute(array_keys($productsCart));

    $Products = $stmt->fetchAll();
}
?>
<?php require __DIR__ . '/incl/header.php'; ?>
<?php require __DIR__ . '/incl/navbar.php'; ?>
<main role="main">
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
<h1>Můj košík</h1>
<p>Celkem položek: <?= @count($Products) ?></p>
    <br>
    <a class="btn btn-dark" href="index.php">Zpět na hlavní stránku!</a>
    <br><br>
    <?php if(@$Products): ?>
    <div class="products">
        <?php foreach($Products as $product): ?>
        <div class="card product col-md-4 col-sm-6">
            <div class="row">
                <div class="col-5">
                    <img class="card-img-top img-fluid" src="<?php echo $product['img'] ? $product['img'] : 'https://via.placeholder.com/190x200" alt="Card image'?>">
                </div> 
                <div class="col-7">
                    <div class="card-body">
                        <h4 class="card-title"><?php echo $product['name'] ?></h4>
                        <div class="card-subtitle"><?php echo $product['price'] ?> Kč</div>
                        <div class="col-auto nopadding">
                            <div class="card-text font-weight-bold"><?php echo $productsCart[$product['products_id']] ?> ks</div>
                        </div>
                        <div class="col-auto">
                            <form action="./buy.php?id=<?php echo $product['products_id'] ?>" method="POST">
                                <input class="btn btn-secondary btn-sm" type="submit" name ="add" value="+">
                            </form>
                        </div>
                        <div class="col-auto">
                            <form action="./buy.php?id=<?php echo $product['products_id'] ?>" method="POST">
                            <input class="btn btn-secondary btn-sm" type="submit" name="remove" value="–" <?php echo ((int)$productsCart[$product['products_id']]===1)?'disabled':''?>>
                            </form>
                        </div>
                        <br>
                        <div class="col-auto">
                            <form action="removeCart.php" method="POST">
                                <input class="d-none" name="productToRemove" value="<?php echo $product['products_id'] ?>">
                                <button type="submit" class="btn btn-dark">Odebrat</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <br>
    <p class="font-weight-bold">Celková cena: <?php echo @$sumPrice; ?> Kč</p>    
    <a class="btn btn-dark" href="order.php">Odeslat objednávku</a>
    <?php else: ?>
    <h6>Žádné položky v košíku</h6>
    <?php endif; ?>
</main>

<?php require __DIR__ . '/incl/footer.php'; ?>