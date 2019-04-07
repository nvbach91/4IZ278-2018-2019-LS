<?php
require 'db.php';
require 'manager_require.php';

if(isset($_GET['id'])){
    $idToUpdate = $_GET['id'];
    $productsToUpdate = $goodsDB->fetch('id', $idToUpdate);
    $productToUpdate = $productsToUpdate[0];
}

$errors=[];

if (!empty($_POST)){
    $enteredName = $_POST['name'];
    $enteredDescription = $_POST['description'];
    $enteredPrice = $_POST['price'];

    if (!$enteredName){
        array_push($errors, 'Write a name of the product!');
    }
    if (!$enteredDescription){
        array_push($errors, 'Write a description of the product!');
    }
    if (!$enteredPrice){
        array_push($errors, 'Write a price of the product!');
    }
    if(!count($errors)){
        $goodsDB->update(['id'=>$idToUpdate],['name'=>$enteredName, 'description'=>$enteredDescription, 'price'=>$enteredPrice]);
        header('Location: index.php?update');
        die();
    }    
}
?>

<?php require './components/header.php'; ?>

<main class="container">
    <h1>Edit the product</h1>
    <form class="form-signup" method="POST" action="update.php?id=<?php echo $idToUpdate; ?>">
        <?php if(count($errors)): ?>
            <div class="alert alert-danger">
                <?php foreach($errors as $error): ?>
                <p><?php echo $error; ?></p>
                <?php endforeach ?>
            </div>
            <?php endif ?>
        <div class="form-group">
            <label>Name</label>
            <input class="form-control" name="name" value="<?php echo isset($enteredName)?$enteredName:@$productToUpdate['name']; ?>">
        </div>
        <div class="form-group">
            <label>Description</label>
            <textarea class="form-control" name="description" value="description"><?php echo isset($enteredDescription)?$enteredDescription:@$productToUpdate['description']; ?></textarea>
        </div>
        <div class="form-group">
            <label>Price</label>
            <input class="form-control" type="number" step=".01" name="price" min="0" value="<?php echo isset($enteredPrice)?$enteredPrice:@$productToUpdate['price']; ?>">
        </div>
        <button class="btn btn-dark" type="submit">Edit</button>
    </form>
</main>

<?php require './components/footer.php'; ?>