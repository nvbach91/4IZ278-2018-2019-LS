<?php
require './db.php';
require  './user_req.php';

$messages = [];

$logged_user  = $usersDB->fetchBy('users_id',$_SESSION['id']);
if($logged_user){
  $privilege = (int)$logged_user[0]['privilege'];
}

if(isset($_GET['signup'])){
  array_push($messages, 'Uživatel byl úspěšně zaregistrován.');
}
if(isset($_GET['login'])){
  array_push($messages, 'Uživatel byl úspěšně přihlášen.');
}
if(isset($_GET['update'])){
  array_push($messages, 'Produkt byl upraven.');
}
if(isset($_GET['create'])){
  array_push($messages, 'Produkt byl vytvořen.');
}
if(isset($_GET['delete'])){
  array_push($messages, 'Produkt byl vymazán.');
}

# offset pro strankovani
if (isset($_GET['offset'])) {
  $offset = (int)$_GET['offset'];
} else {
  $offset = 0;
}

//kategorie
if(isset($_GET['category'])){
  $currentCategory= $_GET['category'];
  $count = $productsDB->getPDO()->prepare("SELECT COUNT(products_id) FROM products_eshop WHERE category = :pickedCategory");
  $count->execute(['pickedCategory'=>$currentCategory]);
  $count = $count->fetchColumn();
  $stmt = $productsDB->getPDO()->prepare("SELECT * FROM products_eshop WHERE category = ? ORDER BY products_id ASC LIMIT 6 OFFSET ?");
  $stmt->bindValue(1, $currentCategory, PDO::PARAM_INT);
  $stmt->bindValue(2, $offset, PDO::PARAM_INT);
  $stmt->execute();
}else{
  $count = $productsDB->getPDO()->query("SELECT COUNT(products_id) FROM products_eshop")->fetchColumn();
  $stmt = $productsDB->getPDO()->prepare("SELECT * FROM products_eshop ORDER BY products_id DESC LIMIT 9 OFFSET ?");
  $stmt->bindValue(1, $offset, PDO::PARAM_INT);
  $stmt->execute();
}
$categories = $categoriesDB->fetchAll();
$products = $stmt->fetchAll();
?>
<?php require __DIR__ . '/incl/header.php'; ?>
<?php require __DIR__ . '/incl/navbar.php'; ?>
<main role="main" style="margin: 30px;">

<?php if(count($messages)): ?>
        <div class="alert alert-success">
            <?php foreach($messages as $message): ?>
              <p><?php echo $message; ?></p>
            <?php endforeach ?>
        </div>
<?php endif ?>

<?php if($privilege > 1): ?>
  <h2>Administrátorské nástroje</h2>
  <a class="btn btn-dark" href="createProduct.php">Přidejte nový produkt!</a>
<?php endif; ?>
<?php if($privilege > 1): ?>
  <a class="btn btn-dark" href="privileges_settings.php">Správa uživatelů</a>
<?php endif; ?>
<?php if($privilege > 1): ?>
  <a class="btn btn-dark" href="admin_orders.php">Správa objednávek</a>
<?php endif; ?>

<h2>Produkty</h1>

<div class="row">
      <!-- Genres -->
      <div class="col-lg-3">
        <div class="list-group">
        <a href="./index.php" class="list-group-item list-group-item-dark text-dark">Všechny kategorie</a>
          <?php foreach($categories as $category): ?>
              <a href="./index.php?category=<?php echo strtolower($category['category_id']);?>" class="list-group-item list-group-item-dark text-dark"><?php echo $category['name'] ?></a>
          <?php endforeach; ?>
        </div>
      </div>
  </div>    
<p class="text-center font-weight-bold">Celkem produktů: <?php echo $count ?></p>
<div class="row">
  <?php if ($count) { ?>
    <?php foreach($products as $product): ?>
      <div class="col-lg-4 col-md-6">
          <div class="card h-100 product" id="productCard">
            <div class="col-5">
              <img class="card-img-top product-image" src="<?php echo $product['img'] ? $product['img'] : 'https://via.placeholder.com/200x200" alt="archery-product-image' ?>">
            </div>
            <div class="card-body">
              <h4 class="card-title"><?php echo $product['name']; ?></h4>
              <h5><?php echo number_format($product['price'], 2), ' ', GLOBAL_CURRENCY; ?></h5>
              <p class="card-text"><?php echo $product['description']; ?></p>
              <a class="btn btn-dark" href='./buy.php?id=<?php echo $product['products_id'] ?>'>Přidat do košíku</a>
              <?php if($privilege > 1): ?>
                  <a class="btn btn-secondary" href='./editProduct.php?id=<?php echo $product['products_id'] ?>'>Upravit</a>
                  <a class="btn btn-secondary" href='./deleteProduct.php?id=<?php echo $product['products_id'] ?>'>Smazat</a>
              <?php endif; ?>
            </div>
          </div>
      </div>
    <?php endforeach; ?>
</div>
<br/>
  <ul class="pagination">
    <li class="page-item">
            <?php for ($i = 1; $i <= ceil($count / 10); $i++) { ?>
                <a class="<?php echo $offset / 10 + 1 == $i ? "active" : ""; ?> page-link" href="./index.php?offset=<?php echo ($i - 1) * 10;
                ?>"><?php echo $i; ?></a>
            <?php } ?>
    </li>
    </ul>
        <?php } ?>
</main>

<?php require __DIR__ . '/incl/footer.php'; ?>