<?php require __DIR__ . '/incl/header.php';?>

<?php require __DIR__ . '/incl/nav.php';?>

<?php
require_once __DIR__ . './db/UsersDB.php';

$usersDB = new UsersDB();

$editId = @$_POST['id'];
$editAuthority = @$_POST['authority'];

if (isset($editId)) {
    $usersDB->editAuthority([
        'id' => $editId,
        'authority' => $editAuthority,
    ]);
}

$userList = $usersDB->fetchAll();
?>

  <table class="table">
      <thead>
        <tr>
          <th>Id</th>
          <th>E-mail</th>
          <th>Authority</th>
          <th>action</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($userList as $user): ?>
        <form method="POST">
          <tr>
            <td><input type="hidden" name="id" value="<?php echo $user['id']; ?>"/> <?php echo $user['id']; ?></td>
            <td><?php echo $user['email']; ?></td>
            <td>
            <input type="number" min="1" max="3" name="authority" value="<?php echo $user['authority']; ?>" />
            </td>
            <td><button type="submit" class="btn btn-primary">Edit</button></td>
          </tr>
      </form>
      <?php endforeach;?>
      </tbody>
    </table>

<?php require __DIR__ . '/incl/footer.php';?>