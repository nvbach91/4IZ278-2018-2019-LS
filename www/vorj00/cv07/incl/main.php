<?php

$offset = isset($_GET['offset']) ? $_GET['offset'] : 0;

require __DIR__ . '/../db/GoodsDB.php';

$goods = new GoodsDB();

$results = $goods->fetchPage($offset);
?>

  <main class="container">
      <!-- The main, dynamic content -->
    <div class="container">
      <div class="row">
      <?php foreach ($results as $result): ?>
      <div class="col-lg-4 col-md-6 mb-4">
        <div class="card" style="width: 18rem;">
          <div class="card-body">
            <h5 class="card-title"><?php echo $result['name'] ?></h5>
            <p class="card-text"><?php echo $result['description'] ?></p>
            <a href="#" class="card-link">Card link</a>
            <a href="#" class="card-link">Another link</a>
          </div>
        </div>
        </div>
        <?php endforeach;?>
      </div>
    </div>
  </main>
