<?php

require __DIR__ . '/db/SlidesDB.php';

$slides = new SlidesDB();

$slidesResults = $slides->fetchAll();
?>

<div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
          <ol class="carousel-indicators">
          <?php foreach ($slidesResults as $i): ?>
                <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo ($i['id']-1) ?>" class="<?php echo ($i['id']-1) === 0 ? 'active' : ''; ?>"></li>
            <?php endforeach;?>
          </ol>
          <div class="carousel-inner" role="listbox">
          <?php foreach ($slidesResults as $i): ?>
            <div class="carousel-item <?php echo ($i['id']-1) === 0 ? "active" : '' ?>">
              <img class="d-block img-fluid" src="<?php echo $i['img']; ?>" alt="First slide">
            </div>
          <?php endforeach;?>
          </div>
          <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
</div>
