<?php

$name = @$_POST['name'];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    setcookie("name", $_POST['name'], time() + 3600);
   header('Location: index.php');
   die();
}
?>
<?php require './incl/header.php'; ?>
   <?php include './incl/nav.php'; ?>
   <main class="container">
      <h1>Login</h1>
      <form method="POST">
         <div class="form-group">
            <label for="name">Name</label>
            <input class="form-control" id="name" name="name" placeholder="Name">
         </div>
         <button type="submit" class="btn btn-primary">Submit</button>  
      </form>
   </main>
<?php require './incl/footer.php'; ?>