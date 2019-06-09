<?php 
session_start();
require './db.php';
require './fb-login/fb-init.php';

$errors=[];
$messages = [];

if ('POST' == $_SERVER['REQUEST_METHOD']) {
  $email = $_POST['email'];
  $formPassword = $_POST['password'];

  if(!$email){
    array_push($errors, "Zadejte svůj e-mail, prosím!");
 }
  if(!$formPassword){
    array_push($errors, "Zadejte své heslo, prosím!");
 }else{
    $users = $usersDB->fetchBy('email', $email);
    $user=[];
    if($users){
      $user=$users[0];
    }
    if (!$user){
      array_push($errors, "uživatel není");
  }else{
      if($formPassword != $user['password']){
          array_push($errors, "špatné heslo");
      }else{
          $_SESSION['id'] = $user['users_id'];
          $_SESSION['email'] = $user['email'];
          header('Location: index.php?login=success');
          die();
      }
    }     
  }   
}
?>

<?php require __DIR__ . '/incl/header.php'; ?>

<?php require __DIR__ . '/incl/navbar.php'; ?>

<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/cs_CZ/sdk.js#xfbml=1&version=v3.3&appId=348564142525844&autoLogAppEvents=1"></script>

<main class="container">
<h1>Přihlášení uživatele</h1>
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
        <input class="form-control" id="email" name="email" placeholder="email">
    </div>
    <div class="form-group">
        <input type="password" class="form-control" id="password" name="password" placeholder="heslo"/>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-dark" name="submit" value="Přihlásit se">
    </div>
    <div class="fb-login-button" data-width="" data-size="large" data-button-type="continue_with" data-auto-logout-link="false" data-use-continue-as="false"></div>
    <p class="text-center">Nemáte zde účet? <a href="./registration.php">Zaregistrujte se!</a></p>
</form>
</main>


<?php require __DIR__ . '/incl/footer.php'; ?>