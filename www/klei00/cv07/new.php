<?php
require 'db.php';

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
        $goodsDB->create(['name'=>$enteredName, 'description'=>$enteredDescription, 'price'=>$enteredPrice]);
        header('Location: index.php?create=true');
        die();
    }    
}
?>

<?php require './components/header.php'; ?>

<main class="container">
    <h1>Create new product</h1>
    <form class="form-signup" method="POST" action="new.php">
        <?php if(count($errors)): ?>
            <div class="alert alert-danger">
                <?php foreach($errors as $error): ?>
                <p><?php echo $error; ?></p>
                <?php endforeach ?>
            </div>
            <?php endif ?>
        <div class="form-group">
            <label>Name</label>
            <input class="form-control" name="name" value="<?php echo @$enteredName; ?>">
        </div>
        <div class="form-group">
            <label>Description</label>
            <textarea class="form-control" name="description" value="description"><?php echo @$enteredDescription; ?></textarea>
        </div>
        <div class="form-group">
            <label>Price</label>
            <input class="form-control" type="number" name="price" min="0" value="<?php echo @$enteredPrice; ?>">
        </div>
        <button class="btn btn-dark" type="submit">Create</button>
    </form>
</main>

<?php require './components/footer.php'; ?>