<?php

$errors=[];
$messages = [];

if(isset($_GET['need_login'])){
   array_push($messages, 'If you want to buy something, log in yourself first.');
 }

$name = @$_POST['name'];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   if(!$_POST['name']){
      array_push($errors, "Please, enter your name!");
   }else{
      setcookie("name", $_POST['name'], time() + 3600); 
      header('Location: index.php');
      die();
   }   
}
?>

<?php require './components/header.php'; ?>
   <main class="container padding">
      <h1>Login</h1>
      <form method="POST">
         <?php if(count($messages)): ?>
         <div class="alert alert-warning">
                  <?php foreach($messages as $message): ?>
                  <p><?php echo $message; ?></p>
                  <?php endforeach ?>
         </div>
         <?php endif ?>
         <?php if(count($errors)): ?>
            <div class="alert alert-danger">
                  <?php foreach($errors as $error): ?>
                  <p><?php echo $error; ?></p>
                  <?php endforeach ?>
            </div>
         <?php endif ?>
         <div class="form-group">
            <label for="name">Name</label>
            <input class="form-control" id="name" name="name" placeholder="Name">
         </div>
         <button type="submit" class="btn btn-dark">Submit</button>  
      </form>
      <div style="margin-bottom: 600px"></div>
   </main>
<?php require './components/footer.php'; ?>