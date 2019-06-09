<?php
require 'db.php';
require 'admin_req.php';

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $changing_userEmail = $_POST['email'];
    
    if(!isset($changing_userEmail)){
        die('Chybí email uživatele.');
    }
    $changing_user = $usersDB->fetchBy('email', $changing_userEmail);
    if(!$changing_user){
        array_push($errors, 'Uživatel nenalezen.');
    }else{
        $changing_user = $changing_user[0];
        $old_priv = $changing_user['privilege'];
    }

    $new_priv = @$_POST['privilege'];
    $usersDB->updateBy(['email'=>$changing_userEmail],['privilege'=>$new_priv]);
    header('Location: privileges_settings.php?changed');
    die();
}
?>

<?php require __DIR__ . '/incl/header.php'; ?>
<?php require __DIR__ . '/incl/navbar.php'; ?>

<main role="main">
    <h1>Správa uživatelských práv</h1>
    <form method="POST">
        <?php if(count($errors)): ?>
                <div class="alert alert-danger">
                    <?php foreach($errors as $error): ?>
                    <p><?php echo $error; ?></p>
                    <?php endforeach ?>
                </div>
        <?php endif ?>
        <div class="form-label-group">
            <label for="email">Email</label>
            <input class="form-control" name="email" value="<?php echo @$email; ?>">
         </div>
         <div class="form-label-group">
            <label for="privilege">Privilege</label>
            <select class="form-control" name="privilege">
                <option>1</option>
                <option>2</option>
            </select>
         </div>
         <br>
         <button type="submit" class="btn btn-dark">Změnit</button>  
    </form>
</main>

<?php require __DIR__ . '/incl/footer.php'; ?>