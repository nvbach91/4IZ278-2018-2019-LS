<?php
if(isset($_GET['change'])){
    array_push($messages, 'Údaje byly změněny');
}

if ('POST' == $_SERVER['REQUEST_METHOD']) {
    $firstName = $_POST['first_name'];
    $surname = $_POST['surname'];
    $phone = $_POST['phone'];    

    if (!$firstName || !$surname || !$phone){
        array_push($errors, 'Doplňte chybějící údaje');
    }else{
        if (!preg_match('/^\+[1-9][0-9]{1,2}[0-9]{9}$/', $phone)){
            array_push($errors, 'Telefonní číslo vyplňte ve tvaru +420123456789');
        }
    }
    if(!count($errors)){
      $usersDB->update(['user_id'=>$currentUser[0]['user_id']],['first_name'=>$firstName, 'surname'=>$surname, 'phone'=>$phone]);
      header('Location: profile.php?change&profile');
      die();
  }   
}
?>

<?php if(count($messages)): ?>
    <div class="alert alert-success">
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
<h2>Nastavení profilu</h2>
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