<?php
require './db.php';
require  './user_req.php';

$errors=[];

if(isset($_GET['id'])){
    $updatedID = $_GET['id'];
    $updatedProducts = $productsDB->fetchBy('products_id', $updatedID);
    $updatedProduct = $updatedProducts[0];
}


if (!empty($_POST)){
    $nameValue = $_POST['name'];
    $descriptionValue = $_POST['description'];
    $priceValue = $_POST['price'];
    $imgValue = $_POST['img'];

    if (!$nameValue){
        array_push($errors, 'Zadejte jméno produktu!');
    }
    if (!$descriptionValue){
        array_push($errors, 'Zadejte popis produktu!');
    }
    if (!$priceValue){
        array_push($errors, 'Zadejte cenu produktu!');
    }

    if (!$imgValue){
        array_push($errors, 'Zadejte adresu obrázku produktu!');
    }

    if(!count($errors)){
        $productsDB->updateBy(['products_id'=>$updatedID],['name'=>$nameValue, 'description'=>$descriptionValue, 'price'=>$priceValue,'img'=>$imgValue]);
        header('Location: index.php?update');
        die();
    }    
    
}

?>


<?php require __DIR__ . '/incl/header.php'; ?>
<?php require __DIR__ . '/incl/navbar.php'; ?>

<main role="main" style="margin: 30px;">
<h1>Upravit produkt č.<?php echo $updatedID; ?></h1>
    <form class="form-signup" method="POST">
        <?php if(count($errors)): ?>
            <div class="alert alert-danger">
                <?php foreach($errors as $error): ?>
                <p><?php echo $error; ?></p>
                <?php endforeach ?>
            </div>
            <?php endif ?>
        <div class="form-group">
            <label>Název</label>
            <input class="form-control" name="name" value="<?php echo @$nameValue; ?>">
        </div>
        <div class="form-group">
            <label>Popis</label>
            <textarea class="form-control" name="description" value="description"><?php echo @$descriptionValue; ?></textarea>
        </div>
        <div class="form-group">
            <label>Cena</label>
            <input class="form-control" type="number" name="price" min="0" value="<?php echo @$priceValue; ?>">
        </div>
        <div class="form-group">
            <label>Obrázek</label>
            <input class="form-control" name="img" value="<?php echo @$imgValue; ?>">
        </div>
        <button class="btn btn-primary text-center" type="submit" action="editProduct.php">Potvrdit změny</button>
    </form>
</main>

<?php require __DIR__ . '/incl/footer.php'; ?>