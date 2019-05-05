<?php
session_start();
require 'db.php';
require_once __DIR__.'/facebook/logger.php'; 

// Facebook
$fb = new \Facebook\Facebook([
    'app_id' => '353829385257639',
    'app_secret' => '5823485577286f1900e22da50cbe773e',
    'default_graph_version' => 'v2.10'
]);
$helper = $fb->getRedirectLoginHelper();
$permissions = ['email'];
$loginUrl = $helper->getLoginUrl(
    'https://localhost/sem/facebook/fb-login.php', $permissions
);

$errors=[];
$messages = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $password = @$_POST['password'];
   $email = @$_POST['email'];

   if(!$email){
      array_push($errors, "Zadejte svůj přihlašovací e-mail");
   }
   if(!$password){
      array_push($errors, "Zadejte heslo");
   }else{
      $users = $usersDB->fetch('email', $email);
      $user=[];
      if($users){
         $user=$users[0];
      }
      if (!$user){
         array_push($errors, "Neznámý e-mail");
     }else{
         if(!password_verify($password, $user['password'])){
            array_push($errors, "Chybné heslo");
         }else{
            $_SESSION['userID'] = $user['user_id'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = $user['role'];
            header('Location: index.php?login');
            die();
         }
     }     
   }   
}
?>

<?php require './components/header.php'; ?>
   <main class="container padding">
      <h1>Přihlášení</h1>
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
            <label for="email">E-mail</label>
            <input class="form-control" id="email" name="email" placeholder="jan.novak@gmail.com" value="<?php echo @$email; ?>">
         </div>
         <div class="form-label-group">
            <label for="password">Heslo</label>
            <input class="form-control" type="password" id="password" name="password">
         </div>
         <br>
         <button type="submit" class="btn btn-dark">Přihlásit se</button>  
      </form>
      <p>Nemáte ještě svůj účet? <a class="text-dark font-weight-bold" href="signup.php" title="Sign up">Zaregistrujte se</a> nebo se přihlašte přes <a class="text-dark font-weight-bold" href="<?php echo @$loginUrl;?>"><i class="fa fa-facebook-square"></i> Facebook</a></p>
      <div style="margin-bottom: 300px"></div>
   </main>
<?php require './components/footer.php'; ?>