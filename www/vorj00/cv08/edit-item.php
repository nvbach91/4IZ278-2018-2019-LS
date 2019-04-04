<?php require __DIR__ . '/incl/header.php';?>

<?php require __DIR__ . '/incl/nav.php';?>

<?php
require_once __DIR__ . './db/GoodsDB.php';

$id = $_GET['id'];
$name = @$_POST['name'];
$description = @$_POST['description'];
$price = @$_POST['price'];

$goodsDB = new GoodsDB();

if (isset($name) && isset($description) && isset($price)) {
    $goodsDB->update([
        'id' => $id,
        'name' => $name,
        'description' => $description,
        'price' => $price,
    ]);
    echo "yeah!";
}

$goodsItem = $goodsDB->getGoodsWholeItem(1);

?>

<form method="POST">
  <div class="form-group">
    <label for="name">Name</label>
    <input type="text" class="form-control" id="name" name="name" aria-describedby="emailHelp" value="<?php echo $goodsItem['name'] ?>">
  </div>
  <div class="form-group">
    <label for="description">Description</label>
    <input type="text" class="form-control" id="description" name="description" value="<?php echo $goodsItem['description'] ?>">
  </div>
  <div class="form-group">
    <label for="price">Price</label>
    <input type="number" class="form-control" id="price" name="price" value="<?php echo $goodsItem['price'] ?>">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>

<?php require __DIR__ . '/incl/footer.php';?>