<?php
require 'db.php';
require 'admin_require.php';

$messages = [];
if(isset($_GET['changed'])){
    array_push($messages, 'Role uživatele byla změněna');
}
$users = $usersDB->fetchAll();
?>

<?php require __DIR__.'/components/header.php'; ?>
<main class="container padding">
    <h1>Správa uživatelů</h1>
    <?php if(count($messages)): ?>
        <div class="alert alert-success">
                <?php foreach($messages as $message): ?>
                <p><?php echo $message; ?></p>
                <?php endforeach ?>
        </div>
    <?php endif ?>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Email</th>
                <th scope="col">Role</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($users as $user): ?>
            <tr>
                <td><?php echo @$user['user_id'];?></td>
                <td><?php echo @$user['email'];?></td>
                <td><?php echo @$user['role'];?></td>
                <td><a href="change_privilege.php?id=<?php echo @$user['user_id'];?>" class="btn btn-dark">Změnit roli</a></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</main>
<?php require __DIR__.'/components/footer.php'; ?>