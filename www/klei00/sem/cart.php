<?php

require 'db.php';
require 'user_require.php';

$goodsInCart = @$_SESSION['cart'];
if (is_array($goodsInCart) && count($goodsInCart)) {
    $question_marks = str_repeat('?,', count($goodsInCart) - 1) . '?';
    
    $statement = $booksDB->getPDO()->prepare("SELECT * FROM books WHERE book_code IN ($question_marks) ORDER BY title");
    $statement->execute(array_values($goodsInCart));
    $books = $statement->fetchAll();
    
    $statementSum = $booksDB->getPDO()->prepare("SELECT SUM(price) FROM books WHERE book_code IN ($question_marks)");
    $statementSum->execute(array_values($goodsInCart));
    $sum = $statementSum->fetchColumn();
}
?>

<?php include './components/header.php' ?>
<main class="container">
    <h1>Nákupní košík</h1>
    <p>Knih v košíku: <?= @count($books) ?></p>
    <br>
    <a class="btn btn-dark" href="index.php">Zpět k nákupu</a>
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
                    <div class="card-subtitle"><?php echo $book['author'] ?></div>
                    <div class="card-text"><?php echo $book['price'] ?> Kč</div>
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
    <?php else: ?>
    <h5>Váš košík je prázdný.</h5>
    <?php endif; ?>
</main>
<?php require './components/footer.php'; ?>