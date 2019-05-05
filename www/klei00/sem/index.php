<?php
require 'db.php';
require 'user_require.php';

//user role
$currentUser = $usersDB->fetch('user_id', $_SESSION['userID']);
if($currentUser){
  $role = (int)$currentUser[0]['role'];
}

// errors and messages
$messages = [];
$warnings = [];

if(isset($_GET['signup'])){
  array_push($messages, 'Byli jste úspěšně zaregistrováni');
}
if(isset($_GET['login'])){
  array_push($messages, 'Přihlášení proběhlo úspěšně');
}
if(isset($_GET['update'])){
  array_push($messages, 'Produkt byl změněn');
}
if(isset($_GET['create'])){
  array_push($messages, 'Byl vytvořen nový produkt');
}
if(isset($_GET['delete'])){
  array_push($messages, 'Produkt byl smazán');
}
if(isset($_GET['current_editor'])){
  array_push($warnings, 'Produkt je momentálně upravován uživatelem '.$_GET['current_editor'].'. Zkuste to později.');
}

// pagination
if (isset($_GET['offset'])) {
    $offset = (int)$_GET['offset'];
} else {
    $offset = 0;
}

// Show books in particular genre
if(isset($_GET['genre'])){
  $currentGenre = $_GET['genre'];
  $count = $booksDB->getPDO()->prepare("SELECT COUNT(book_code) FROM books WHERE genre = :genreToInsert");
  $count->execute(['genreToInsert'=>$currentGenre]);
  $count = $count->fetchColumn();
  $statement = $booksDB->getPDO()->prepare("SELECT * FROM books WHERE genre = ? ORDER BY title ASC LIMIT 6 OFFSET ?");
  $statement->bindValue(1, $currentGenre, PDO::PARAM_STR);
  $statement->bindValue(2, $offset, PDO::PARAM_INT);
  $statement->execute();
}else{
  //show all books
  $count = $booksDB->getPDO()->query("SELECT COUNT(book_code) FROM books")->fetchColumn();

  $statement = $booksDB->getPDO()->prepare("SELECT * FROM books ORDER BY title ASC LIMIT 6 OFFSET ?");
  $statement->bindValue(1, $offset, PDO::PARAM_INT);
  $statement->execute();
}
$books = $statement->fetchAll();
$genres = $genresDB->fetchAllOrdered('name');
?>

<?php require __DIR__.'/components/header.php' ?>

  <!-- Page Content -->
  <main class="container padding">

  <!-- Messages -->
  <?php if(count($messages)): ?>
        <div class="alert alert-success">
                <?php foreach($messages as $message): ?>
                <p><?php echo $message; ?></p>
                <?php endforeach ?>
        </div>
    <?php endif ?>
    <?php if(count($warnings)): ?>
        <div class="alert alert-warning">
                <?php foreach($warnings as $warning): ?>
                <p><?php echo $warning; ?></p>
                <?php endforeach ?>
        </div>
    <?php endif ?>
    
    <h1>Knihy</h1>
    <p>Celkem knih: <?php echo $count ?></p>
    <?php if($role > 2): ?>
      <a class="btn btn-dark" href="users.php">Správa uživatelů</a>
    <?php endif; ?>
    <?php if($role > 1): ?>
      <a class="btn btn-dark" href="orders.php">Správa objednávek</a>
      <a class="btn btn-dark" href="stock.php">Skladové zásoby</a>
      <a class="btn btn-dark" href="new.php">Přidat novou knihu</a>
      <br>
    <?php endif; ?>
    <br>
    <div class="row">

      <!-- Genres -->
      <div class="col-lg-3">
        <div class="list-group">
        <a href="./index.php" class="list-group-item list-group-item-dark text-dark">Všechny žánry</a>
          <?php foreach($genres as $genre): ?>
              <a href="./index.php?genre=<?php echo strtolower($genre['genre_code']);?>" class="list-group-item list-group-item-dark text-dark"><?php echo $genre['name'] ?></a>
          <?php endforeach; ?>
        </div>
      </div>

      <!-- Books -->
      <div class="col-lg-9">        
        <?php if($count){ ?>
        <div class="products row">
          <?php foreach($books as $book): ?>
            <div class="card product col-md-6">
              <div class="row">
                <div class="col-5">
                  <img class="card-img-top img-fluid" src="<?php echo $book['image'] ? $book['image'] : 'https://via.placeholder.com/190x300" alt="Card image' ?>">
                </div>  
                <div class="col-7">  
                  <div class="card-body">
                    <h4 class="card-title"><?php echo $book['title'] ?></h4>
                    <div class="card-subtitle"><?php echo $book['author'] ?></div>
                    <div class="card-text"><?php echo $book['price'] ?> Kč | <?php echo $book['in_stock'] ? 'Skladem' : 'Není skladem'?></div>
                    <?php if($role == 1): ?>
                        <a class="btn btn-dark <?php echo (int)$book['in_stock']==0 ? 'disabled' : '' ?>" href='./buy.php?book=<?php echo $book['book_code'] ?>'>Koupit</a>
                    <?php endif; ?>
                    <?php if($role > 1): ?>
                        <a class="btn btn-dark" href='./update.php?book=<?php echo $book['book_code'] ?>'>Upravit</a>
                        <a class="btn btn-dark" href='./delete.php?book=<?php echo $book['book_code'] ?>'>Smazat</a>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
    <br>
    <div class="pagination">
      <?php for ($i = 1; $i <= ceil($count / 6); $i++) { ?>
        <a class="<?php echo $offset / 6 + 1 == $i ? "active" : ""; ?>" href="./index.php?offset=<?php echo ($i - 1) * 6;
        echo isset($currentGenre)?'&genre='.$currentGenre:''?>"><?php echo $i; ?></a>
      <?php } ?>
    </div>
    <br>
    <?php } ?>
      </main>
<?php require __DIR__.'/components/footer.php' ?>