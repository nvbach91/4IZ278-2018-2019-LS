<?php
require 'db.php';
require 'manager_require.php';

$books = $booksDB->fetchAllOrdered('title');

$errors=[];

if (!empty($_POST)){
    $enteredBook = $_POST['book'];
    $enteredQuantity = $_POST['quantity'];
    $currentQuantity = ($booksDB->fetch('book_code',$enteredBook))[0]['in_stock'];
    
    if(isset($_POST['add'])){
        $newQuantity = (int)$currentQuantity + (int)$enteredQuantity;
        $booksDB->update(['book_code'=>$enteredBook],['in_stock'=>$newQuantity]);
        header('Location: stock.php?stock');
        die();
    }
    if(isset($_POST['remove'])){
        $newQuantity = (int)$currentQuantity - (int)$enteredQuantity;
        if($newQuantity<0){
            array_push($errors, 'Stav zásob nemůže být záporný');
        }else{
            $booksDB->update(['book_code'=>$enteredBook],['in_stock'=>$newQuantity]);
            header('Location: stock.php?stock');
            die();
        }
    }
}
?>

<?php require './components/header.php'; ?>

<main class="container">
    <h1>Změna skladových zásob</h1>
    <form class="form-signup" method="POST" action="change_stock.php">
        <?php if(count($errors)): ?>
            <div class="alert alert-danger">
                <?php foreach($errors as $error): ?>
                <p><?php echo $error; ?></p>
                <?php endforeach ?>
            </div>
            <?php endif ?>
        <div class="form-group">
            <label>Kniha</label>
            <select class="form-control" name="book">
                <?php foreach($books as $book):?>
                    <option value="<?php echo $book['book_code'];?>" <?php
                        if (isset($enteredBook)){
                            if($enteredBook === $book['book_code']){
                                echo 'selected';
                            }
                        }
                    ?>><?php echo $book['title'].' - '.$book['author'].' ('.$book['in_stock'].' ks)';?></option>
                <?php endforeach;?>
            </select>
        </div>
        <div class="form-group">
            <label>Počet kusů</label>
            <input class="form-control" type="number" min=1 name="quantity" value="<?php echo isset($enteredQuantity)?$enteredQuantity:''; ?>" required>
        </div>
        <input class="btn btn-dark" type="submit" name="add" value="Naskladnit">
        <input class="btn btn-dark" type="submit" name="remove" value="Vyskladnit">
    </form>
    <div style="margin-bottom: 300px"></div>
</main>

<?php require './components/footer.php'; ?>