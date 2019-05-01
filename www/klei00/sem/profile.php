<?php

require 'db.php';
require 'user_require.php';

$errors = [];

if ('POST' == $_SERVER['REQUEST_METHOD']) {
    $firstName = $_POST['first_name'];
    $surname = $_POST['surname'];
    $phone = $_POST['phone'];

    if (!$first_name || !$surname || !$email || !$phone){
        array_push($errors, 'Doplňte chybějící údaje');
    }else{
        if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
            array_push($errors,'Vyplňte e-mail ve správném formátu');
        }
        if (!preg_match('/^\+[1-9][0-9]{1,2}[0-9]{9}$/', $phone)){
            array_push($errors, 'Telefonní číslo vyplňte ve tvaru +420123456789');
        }
    }
    if(!count($errors)){
      $usersDB->update(['user_id'=>$currentUser[0]],['firstName'=>$firstName, 'surname'=>$surname, 'phone'=>$phone]);
      header('Location: index.php?update');
      die();
  }   
}

?>

<?php require './components/header.php'; ?>
   <main class="container padding">
      <h1>Můj profil</h1>
      <form method="POST">
         <div class="form-group">
            <label>Křestní jméno</label>
            <input class="form-control" name="first_name" value="<?php echo isset($firstName)?$firstName:@$currentUser[0]['first_name']; ?>">
         </div>
         <div class="form-group">
            <label>Příjmení</label>
            <input class="form-control" name="surname" value="<?php echo isset($surname)?$surname:@$currentUser[0]['surname']; ?>">
         </div>
         <div class="form-group">
            <label>Telefonní číslo</label>
            <input class="form-control" name="phone" value="<?php echo isset($phone)?$phone:@$currentUser[0]['phone']; ?>">
         </div>
         <button type="submit" class="btn btn-dark">Potvrdit změny</button>
      </form>
      <div style="margin-bottom: 300px"></div>
   </main>
<?php require './components/footer.php'; ?>