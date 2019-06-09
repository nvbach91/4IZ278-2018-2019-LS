<?php

if (!isset($_COOKIE['name'])) {
   header('Location: login.php');
   die();
}
$name = @$_COOKIE['name'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    setcookie("name", $_POST['name'], time() + 3600); 
    header('Location: profile.php');
    die();
 }
?>

<?php require './components/header.php'; ?>
   <main class="container padding">
      <h1>About me</h1>
      <form method="POST">
         <div class="form-group">
            <label for="name">Name</label>
            <input class="form-control" id="name" name="name" placeholder="Name" value="<?php echo $name; ?>">
         </div>
         <button type="submit" class="btn btn-dark">Submit</button> or <a class="text-dark" href="./">Go back to Homepage</a>
      </form>
      <div style="margin-bottom: 600px"></div>
   </main>
<?php require './components/footer.php'; ?>