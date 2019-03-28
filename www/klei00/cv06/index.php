<?php require __DIR__.'/components/header.php' ?>

  <!-- Page Content -->
  <div class="container">

    <div class="row">

      <div class="col-lg-3">

        <h1 class="my-4">Mango Shop</h1>
        <?php require './categories.php' ?>

      </div>
      <!-- /.col-lg-3 -->

      <div class="col-lg-9">

        <?php require './slider.php' ?>
        <?php require './products.php' ?>

      </div>
      <!-- /.col-lg-9 -->

    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->

  <!-- Footer -->

<?php require __DIR__.'/components/footer.php' ?>