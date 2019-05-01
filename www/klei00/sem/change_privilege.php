<?php
require 'db.php';
require 'admin_require.php';

$errors = [];
$idToChange = $_GET['id'];
if(!isset($idToChange)){
    die('Chyba při změně role uživatele.');
}
$userToChange = $usersDB->fetch('user_id', $idToChange);
if(!$userToChange){
    array_push($errors, 'Uživatel nenalezen');
}else{
    $userToChange = $userToChange[0];
    $email = $userToChange['email'];
    $oldPrivilege = $userToChange['role'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newPrivilege = @$_POST['role'];
    $usersDB->update(['user_id'=>$idToChange],['role'=>$newPrivilege]);
    header('Location: users.php?changed');
    die();
}
?>

<?php require './components/header.php'; ?>
   <main class="container padding">
      <h1>Změna role uživatele</h1>
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
            <input class="form-control" name="email" value="<?php echo @$email; ?>" disabled>
         </div>
         <div class="form-label-group">
            <label for="privilege">Role</label>
            <select class="form-control" name="role">
                <option value="1" <?php echo ((int)$oldPrivilege === 1)? 'selected':'' ?>>Zákazník</option>
                <option value="2" <?php echo ((int)$oldPrivilege === 2)? 'selected':'' ?>>Správce</option>
                <option value="3" <?php echo ((int)$oldPrivilege === 3)? 'selected':'' ?>>Aministrátor</option>
            </select>
         </div>
         <br>
         <button type="submit" class="btn btn-dark">Změnit</button>  
      </form>
      <div style="margin-bottom: 300px"></div>
   </main>
<?php require './components/footer.php'; ?>