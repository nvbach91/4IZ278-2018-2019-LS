<?php
require 'db.php';
require 'admin_require.php';

$errors = [];
$idToChange = $_GET['id'];
if(!isset($idToChange)){
    die('Unable to change privileges. ID of the user is missing.');
}
$userToChange = $usersDB->fetch('id', $idToChange);
if(!$userToChange){
    array_push($errors, 'User not found');
}else{
    $userToChange = $userToChange[0];
    $email = $userToChange['email'];
    $oldPrivilege = $userToChange['privilege'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newPrivilege = @$_POST['privilege'];
    $usersDB->update(['id'=>$idToChange],['privilege'=>$newPrivilege]);
    header('Location: users.php?changed');
    die();
}
?>

<?php require './components/header.php'; ?>
   <main class="container padding">
      <h1>Change privileges</h1>
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
            <label for="privilege">Privilege</label>
            <select class="form-control" name="privilege">
                <option <?php echo ((int)$oldPrivilege === 1)? 'selected':'' ?>>1</option>
                <option <?php echo ((int)$oldPrivilege === 2)? 'selected':'' ?>>2</option>
                <option <?php echo ((int)$oldPrivilege === 3)? 'selected':'' ?>>3</option>
            </select>
         </div>
         <br>
         <button type="submit" class="btn btn-dark">Change</button>  
      </form>
      <div style="margin-bottom: 600px"></div>
   </main>
<?php require './components/footer.php'; ?>