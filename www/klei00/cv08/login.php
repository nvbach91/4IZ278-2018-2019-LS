<?php
session_start();
require 'db.php';

$errors=[];
$messages = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $password = @$_POST['password'];
   $email = @$_POST['email'];

   if(!$email){
      array_push($errors, "Please, enter your email!");
   }
   if(!$password){
      array_push($errors, "Please, enter your password!");
   }else{
      $users = $usersDB->fetch('email', $email);
      $user=[];
      if($users){
         $user=$users[0];
      }
      if (!$user){
         array_push($errors, "This user does not exist!");
     }else{
         if(!password_verify($password, $user['password'])){
            array_push($errors, "Wrong password!");
         }else{
            $_SESSION['userID'] = $user['id'];
            $_SESSION['email'] = $user['email'];
            header('Location: index.php?login');
            die();
         }
     }     
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
         <div class="form-label-group">
            <label for="email">Email</label>
            <input class="form-control" id="email" name="email" placeholder="E-mail" value="<?php echo @$email; ?>">
         </div>
         <div class="form-label-group">
            <label for="password">Password</label>
            <input class="form-control" type="password" id="password" name="password">
         </div>
         <br>
         <button type="submit" class="btn btn-dark">Submit</button>  
      </form>
      <p>Don't have an account? <a class="text-dark" href="signup.php" title="Sign up">Sign up</a>!</p>
      <div style="margin-bottom: 600px"></div>
   </main>
<?php require './components/footer.php'; ?>