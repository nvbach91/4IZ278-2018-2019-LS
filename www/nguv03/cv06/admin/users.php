<?php require __DIR__ . '/../db/UsersDB.php'; ?>
<?php
// we create a new instance for each table (users, products) and 
// simply use its public methods
// to achieve this we need OOP
$usersDB = new UsersDB();
$users = $usersDB->fetchAll();
//var_dump($users);
?>
<?php require __DIR__ . '/../incl/header.php'; ?>

<main class="container">
    <?php foreach($users as $user): ?>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title"><?php echo $user['name']; ?></h5>
            <h6 class="card-subtitle mb-2 text-muted"><?php echo $user['email']; ?></h6>
            <p class="card-text"><?php echo file_get_contents('http://loripsum.net/api/1/short/plaintext'); ?></p>
            <a href="#" class="card-link">Visit website</a>
            <a href="#" class="card-link">GitHub profile</a>
        </div>
    </div>
    <?php endforeach; ?>
</main>

<?php require __DIR__ . '/../incl/footer.php'; ?>