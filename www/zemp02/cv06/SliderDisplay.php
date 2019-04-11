<?php
require_once './ProductsDB.php';

$productsDB = new ProductsDB();
//$products = $productsDB->insertTableSlider();
$products = $productsDB->fetchAll('slides');



?>


<div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner" role="listbox">
        <div class="carousel-item active">
            <img class="d-block img-fluid" src="https://timedotcom.files.wordpress.com/2015/06/521811839-copy.jpg" alt="Slide">
            <div class ="carousel-caption">
                <p><?php echo 'tried many things but foreach refused in cooperating with adding active class to first item'; ?></p>
            </div>
        </div>
        <?php foreach ($products as $product):?>
            <div class="carousel-item">
                <img class="d-block img-fluid" src="<?php echo $product['img']; ?>" alt="Slide <?php echo $product['id'];?>">
                <div class ="carousel-caption">
                    <p><?php echo $product['title']; ?></p>
                </div>
            </div>

        <?php endforeach; ?>
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