<?php

require 'db.php';
require 'user_require.php';

$email = @$_SESSION['email'];

?>

<?php require './components/header.php'; ?>
   <main class="container padding">
      <h1>About me</h1>
      <form method="POST">
         <div class="form-group">
            <label for="name">Email</label>
            <input class="form-control" id="name" name="name" placeholder="Name" value="<?php echo $email; ?>">
         </div>
         <button type="submit" class="btn btn-dark">Submit</button> or <a class="text-dark" href="./">Go back to Homepage</a>
      </form>
      <div style="margin-bottom: 600px"></div>
   </main>
<?php require './components/footer.php'; ?>