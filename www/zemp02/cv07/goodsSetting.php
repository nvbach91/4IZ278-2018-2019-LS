<?php
require './Header.php';
require './Navbar.php';
?>
<div class="container">

    <div class="row center justify-content-center justify-content-between my-5">
        <a href="createItem.php" class="btn btn-primary">Create Good</a>
        <a data-toggle="modal" href="#updateID" class="btn btn-primary">Edit Good</a>
        <?php require './updateModal.php' ?>
        <a data-toggle="modal" href="#deleteID" class="btn btn-primary">Delete Good</a>
        <?php require './deleteModal.php' ?>
        <!-- /.row -->

    </div>
    <!-- /.col-lg-9 -->

</div>


<?php
require 'Footer.php';
?>