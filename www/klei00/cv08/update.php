<?php
require 'db.php';
require 'manager_require.php';

if(isset($_GET['id'])){
    $id = $_GET['id'];

    require 'check_lock.php';

    if(empty($_POST)){
        $goodsDB->update(['id'=>$id], ['last_update_started_at'=>date("Y-m-d H:i:s"), 'last_update_by'=>$current_user[0]['id']]);
    }
}

$errors=[];

if (!empty($_POST)){
    $enteredName = $_POST['name'];
    $enteredDescription = $_POST['description'];
    $enteredPrice = $_POST['price'];

    if($product['edit_expired'] || $product['last_update_by'] != $current_user[0]['id']){
        array_push($errors, "The page has expired. Please return to the <a href='index.php'>homepage</a> and try it again.");
    }else{
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
            $goodsDB->update(['id'=>$id],['name'=>$enteredName, 'description'=>$enteredDescription, 'price'=>$enteredPrice,
            'last_update_started_at'=>NULL, 'last_update_by'=>NULL]);
            header('Location: index.php?update');
            die();
        }    
    }
}
?>

<?php require './components/header.php'; ?>

<main class="container">
    <h1>Edit the product</h1>
    <form class="form-signup" method="POST" action="update.php?id=<?php echo $id; ?>">
        <?php if(count($errors)): ?>
            <div class="alert alert-danger">
                <?php foreach($errors as $error): ?>
                <p><?php echo $error; ?></p>
                <?php endforeach ?>
            </div>
            <?php endif ?>
        <div class="form-group">
            <label>Name</label>
            <input class="form-control" name="name" value="<?php echo isset($enteredName)?$enteredName:@$product['name']; ?>">
        </div>
        <div class="form-group">
            <label>Description</label>
            <textarea class="form-control" name="description" value="description"><?php echo isset($enteredDescription)?$enteredDescription:@$product['description']; ?></textarea>
        </div>
        <div class="form-group">
            <label>Price</label>
            <input class="form-control" type="number" step=".01" name="price" min="0" value="<?php echo isset($enteredPrice)?$enteredPrice:@$product['price']; ?>">
        </div>
        <button class="btn btn-dark" type="submit">Edit</button>
    </form>
</main>

<?php require './components/footer.php'; ?>