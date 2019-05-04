<?php

require 'db.php';
require 'user_require.php';

$errors = [];
$messages = [];

?>

<?php require './components/header.php'; ?>
   <main class="container padding">
      <h1>Můj profil</h1>
      <br>
      <div class="row">
        <div class="col-lg-3">
          <div class="list-group">
            <a href="./profile.php?orders" class="list-group-item list-group-item-dark text-dark">Objednávky</a>
            <a href="./profile.php?profile" class="list-group-item list-group-item-dark text-dark">Nastavení profilu</a>
          </div>
        </div>
        <div class="col-lg-9">
          <?php if(isset($_GET['profile'])){
            require './change_profile.php';
          }else if(isset($_GET['order_detail'])){
            require './order_detail.php';
          }else{
            require './my_orders.php';
          }?>
        </div>
      </div>
      <div style="margin-bottom: 300px"></div>
   </main>
<?php require './components/footer.php'; ?>