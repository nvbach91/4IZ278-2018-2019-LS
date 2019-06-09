<?php
require './db.php';
require  './user_req.php';

$errors=[];
$messages = [];

if(isset($_GET['change'])){
    array_push($messages, 'Údaje byly změněny');
}
if ('POST' == $_SERVER['REQUEST_METHOD']) {
    $name_user = $_POST['name'];
    $surname_user = $_POST['surname'];

    if (!$name_user){
        array_push($errors, 'Doplňte chybějící údaje');
    }
    if (!$surname_user){
        array_push($errors, 'Doplňte chybějící údaje');
    }

    if(!count($errors)){
      $usersDB->updateBy(['users_id'=>$logged_user[0]['users_id']],['name'=>$name_user, 'surname'=>$surname_user]);
      header('Location: profile.php?profile_changed');
      die();
  }   
}
?>

<?php require __DIR__ . '/incl/header.php'; ?>

<?php require __DIR__ . '/incl/navbar.php'; ?>

<main class="container">
    <h1>Nastavení profilu</h1>
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
        <label>Křestní jméno</label>
        <input class="form-control" name="name" value="<?php echo isset($name_user)?$name_user:@$logged_user[0]['name']; ?>">
    </div>
    <div class="form-group">
        <label>Příjmení</label>
        <input class="form-control" name="surname"value="<?php echo isset($surname_user)?$surname_user:@$logged_user[0]['surname']; ?>">
    </div>
    <button type="submit" class="btn btn-dark">Potvrdit změny</button>
    </form>
</main>


<?php require __DIR__ . '/incl/footer.php'; ?>