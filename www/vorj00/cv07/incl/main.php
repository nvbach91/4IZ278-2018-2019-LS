<?php

$offset = isset($_GET['offset']) ? $_GET['offset'] : 0;

require __DIR__ . '/../db/GoodsDB.php';

$goods = new GoodsDB();

$results = $goods->fetchPage($offset);
$pages = $goods->countPages();
?>

  <main class="container">
      <!-- The main, dynamic content -->
      <a href="./create-item.php" class="btn btn-primary">New item</a>
    <div class="container">
      <div class="row">
      <?php foreach ($results as $result): ?>
      <div class="col-lg-4 col-md-6 mb-4">
        <div class="card" style="width: 18rem;">
          <div class="card-body">
            <h5 class="card-title"><?php echo $result['name'] ?></h5>
            <p class="card-text"><?php echo $result['description'] ?></p>
            <a href="./buy.php?id=<?php echo $result['id'] ?>" class="card-link">BUY</a>
            <a href="./edit-item.php?id=<?php echo $result['id'] ?>" class="card-link">edit</a>
            <a href="./delete-item.php?id=<?php echo $result['id'] ?>" class="card-link btn btn-danger">delete</a>
          </div>
        </div>
        </div>
        <?php endforeach;?>
      </div>
      <ul class="pagination">
        <?php for ($i = 1; $i <= ceil($pages / 10); $i++): ?>
        <li class="page-item <?php echo $offset / 10 + 1 == $i ? "active" : ""; ?>">
            <a class="page-link" href="./index.php?offset=<?php echo ($i - 1) * 10; ?>"><?php echo $i; ?></a>
        </li>
        <?php endfor;?>
    </ul>
    </div>
  </main>
