<?php
require 'db.php';
require 'manager_require.php';

$errors=[];

if (!empty($_POST)){
    $enteredTitle = $_POST['title'];
    $enteredAuthor = $_POST['author'];
    $enteredPrice = $_POST['price'];
    $enteredImage = $_POST['image'];
    $enteredGenre = $_POST['genre'];

    if (!$enteredTitle || !$enteredAuthor || !$enteredPrice){
        array_push($errors, 'Doplňte chybějící údaje');
    }  
    if(!count($errors)){
        $booksDB->create(['title'=>$enteredTitle, 'author'=>$enteredAuthor, 'price'=>$enteredPrice, 'image'=>$enteredImage, 'genre'=>$enteredGenre]);
        header('Location: index.php?create');
        die();
    }
}
$genres = $genresDB->fetchAll();
?>

<?php require './components/header.php'; ?>

<main class="container">
    <h1>Přidat novou knihu</h1>
    <form class="form-signup" method="POST" action="new.php">
        <?php if(count($errors)): ?>
            <div class="alert alert-danger">
                <?php foreach($errors as $error): ?>
                <p><?php echo $error; ?></p>
                <?php endforeach ?>
            </div>
            <?php endif ?>
        <div class="form-group">
            <label>Název knihy</label>
            <input class="form-control" name="title" value="<?php echo @$enteredTitle; ?>">
        </div>
        <div class="form-group">
            <label>Autor</label>
            <input class="form-control" name="author" value="<?php echo @$enteredAuthor; ?>">
        </div>
        <div class="form-group">
            <label>Cena</label>
            <input class="form-control" type="number" step=".01" name="price" min="0" value="<?php echo @$enteredPrice; ?>">
        </div>
        <div class="form-group">
            <label>URL obrázku</label>
            <input class="form-control" name="image" value="<?php echo @$enteredImage; ?>">
        </div>
        <div class="form-group">
            <label>Žánr</label>
            <select class="form-control" name="genre">
                <option value="">Nespecifikováno</option>
                <?php foreach($genres as $genre):?>
                    <option value="<?php echo $genre['genre_code'];?>"><?php echo $genre['name'];?></option>
                <?php endforeach;?>
            </select>
        </div>
        <button class="btn btn-dark" type="submit">Přidat</button>
    </form>
</main>

<?php require './components/footer.php'; ?>