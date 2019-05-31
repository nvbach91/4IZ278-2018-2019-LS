<?php
require 'db.php';
require 'user_require.php';

$errors = [];
$messages = [];

if(isset($_GET['capacity'])){
  $book=$booksDB->fetch('book_code',$_GET['capacity']);
  if(!$book){
    die('Kniha nebyla nalezena');
  }else{
    array_push($errors, 'Více kusů knihy <i>'.$book[0]['title'].'</i> již nemáme skladem');
  }
}
if(isset($_GET['sent'])){
    array_push($messages, 'Objednávka byla odeslána');
}

// adjusting quantity of books
if(isset($_POST)){
  if(isset($_POST['add'])){
    header('Location: stock.php?change');
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
// books to be showed in cart
$goodsInCart = @$_SESSION['cart'];
$sumPrice = 0;
$sumPieces = 0;
if (is_array($goodsInCart) && count($goodsInCart)) {
  foreach($goodsInCart as $productID=>$pieces){
    $product = $booksDB->fetch('book_code', $productID);
    $sumPrice += $product[0]['price']*$pieces;
    $sumPieces += $pieces;
  }
    $question_marks = str_repeat('?,', count($goodsInCart) - 1) . '?';
    
    $statement = $booksDB->getPDO()->prepare("SELECT * FROM books WHERE book_code IN ($question_marks) ORDER BY title");
    $statement->execute(array_keys($goodsInCart));
    $books = $statement->fetchAll();
}

// back to shopping
if(isset($_SESSION['offset'])){
  $offset=$_SESSION['offset'];
}else{
  $offset=0;
}
if(isset($_SESSION['genre'])){
  $genre = $_SESSION['genre'];
}else{
  $genre = 0;
}
?>

<?php include './components/header.php' ?>
<main class="container">
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
    <h1>Nákupní košík</h1>
    <p>Knih v košíku: <?php echo @$sumPieces; ?></p>
    <br>
    <a class="btn btn-dark" href="index.php?offset=<?php echo $offset; echo $genre?"&genre=".$genre:""; ?>">Zpět k nákupu</a>
    <br><br>
    <?php if(@$books): ?>
    <div class="products">
        <?php foreach($books as $book): ?>
            <div class="card product col-md-4 col-sm-6">
              <div class="row">
                <div class="col-5">
                  <img class="card-img-top img-fluid" src="<?php echo isset($book['image']) ? $book['image'] : 'https://via.placeholder.com/190x300" alt="Card image' ?>">
                </div>  
                <div class="col-7">  
                  <div class="card-body">
                    <h4 class="card-title"><?php echo $book['title'] ?></h4>
                    <h6 class="card-subtitle font-weight-light"><?php echo $book['author'] ?></h6>
                    <div class="row">
                      <div class="col-auto">
                        <form action="buy.php?book=<?php echo $book['book_code'] ?>" method="POST">
                          <input class="btn btn-secondary btn-sm" type="submit" name="remove" value="–" <?php echo ((int)$goodsInCart[$book['book_code']]===1)?'disabled':''?>>
                        </form>
                      </div>
                      <div class="col-auto nopadding">
                        <div class="card-text font-weight-bold"><?php echo $goodsInCart[$book['book_code']] ?> ks</div>
                      </div>
                      <div class="col-auto">
                        <form action="buy.php?book=<?php echo $book['book_code'] ?>" method="POST">
                          <input class="btn btn-secondary btn-sm" type="submit" name="add" value="+" <?php echo ((int)$goodsInCart[$book['book_code']]===(int)$book['in_stock'])?'disabled':''?>>
                        </form>
                      </div>
                    </div>
                    <div class="card-text font-weight-bold"><?php echo (int)$book['price']*(int)$goodsInCart[$book['book_code']] ?> Kč</div>
                    <form action="remove.php" method="POST">
                        <input class="d-none" name="bookToRemove" value="<?php echo $book['book_code'] ?>">
                        <button type="submit" class="btn btn-dark">Odebrat</button>
                    </form>
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
    <h5>Váš košík je prázdný.</h5>
    <?php endif; ?>
</main>
<?php require './components/footer.php'; ?>