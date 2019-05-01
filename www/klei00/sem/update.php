<?php
require 'db.php';
require 'manager_require.php';

if(isset($_GET['book'])){
    $id = $_GET['book'];

    require 'check_lock.php';

    if(empty($_POST)){
        $booksDB->update(['book_code'=>$id], ['last_update_started_at'=>date("Y-m-d H:i:s"), 'last_update_by'=>$currentUser[0]['user_id']]);
    }
}

$errors=[];

if (!empty($_POST)){
    $enteredTitle = $_POST['title'];
    $enteredAuthor = $_POST['author'];
    $enteredPrice = $_POST['price'];
    $enteredImage = $_POST['image'];
    $enteredGenre = $_POST['genre'];

    if($product['edit_expired'] || $product['last_update_by'] != $currentUser[0]['user_id']){
        array_push($errors, "Platnost stránky vypršela. Vraťte se na <a href='index.php' class='text-danger'>hlavní stránku</a> a zkuste to znovu.");
    }else{
        if (!$enteredTitle || !$enteredAuthor || !$enteredPrice){
            array_push($errors, 'Doplňte chybějící údaje');
        }  
        if(!count($errors)){
            $booksDB->update(['book_code'=>$id],['title'=>$enteredTitle, 'author'=>$enteredAuthor, 'price'=>$enteredPrice,
            'image'=>$enteredImage, 'genre'=>$enteredGenre, 'last_update_started_at'=>NULL, 'last_update_by'=>NULL]);
            header('Location: index.php?update');
            die();
        }
    }    
}
$genres = $genresDB->fetchAll();
?>

<?php require './components/header.php'; ?>

<main class="container">
    <h1>Upravit knihu</h1>
    <form class="form-signup" method="POST" action="update.php?book=<?php echo $id; ?>">
        <?php if(count($errors)): ?>
            <div class="alert alert-danger">
                <?php foreach($errors as $error): ?>
                <p><?php echo $error; ?></p>
                <?php endforeach ?>
            </div>
            <?php endif ?>
        <div class="form-group">
            <label>Název knihy</label>
            <input class="form-control" name="title" value="<?php echo isset($enteredTitle)?$enteredTitle:@$product['title']; ?>">
        </div>
        <div class="form-group">
            <label>Autor</label>
            <input class="form-control" name="author" value="<?php echo isset($enteredAuthor)?$enteredAuthor:@$product['author']; ?>">
        </div>
        <div class="form-group">
            <label>Cena</label>
            <input class="form-control" type="number" step=".01" name="price" min="0" value="<?php echo isset($enteredPrice)?$enteredPrice:@$product['price']; ?>">
        </div>
        <div class="form-group">
            <label>URL obrázku</label>
            <input class="form-control" name="image" value="<?php echo isset($enteredImage)?$enteredImage:@$product['image']; ?>">
        </div>
        <div class="form-group">
            <label>Žánr</label>
            <select class="form-control" name="genre">
                <option value="">Nespecifikováno</option>
                <?php foreach($genres as $genre):?>
                    <option value="<?php echo $genre['genre_code'];?>" <?php
                        if (isset($enteredGenre)){
                            if($enteredGenre === $genre['genre_code']){
                                echo 'selected';
                            }
                        }else{
                            if(@$product['genre'] === $genre['genre_code']){
                                echo 'selected';
                            }
                        }
                    ?>><?php echo $genre['name'];?></option>
                <?php endforeach;?>
            </select>
        </div>
        <button class="btn btn-dark" type="submit">Potvrdit změny</button>
    </form>
</main>

<?php require './components/footer.php'; ?>