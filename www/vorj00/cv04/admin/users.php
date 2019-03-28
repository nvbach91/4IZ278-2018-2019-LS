<?php require '../components/header.php'?>

<?php
$names = [];

$lines = file('../database/users.db');
$users = [];

foreach ($lines as $line) {
    $fields = explode(';', $line);
    $record = [
        'name' => $fields[0],
        'email' => $fields[1],
        'password' => $fields[2],
    ];

    $users[] = $record;
}

?>

<main class="container">
    <br>
    <em>Zkopíroval jsem jen HTML, PHP ne</em>
    <h1 class="text-center">Users</h1>
    <?php foreach ($users as $user): ?>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><?php echo $user['name']; ?></h5>
                <h6 class="card-subtitle mb-2 text-muted"><?php echo $user['email']; ?></h6>
                <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum ad eos saepe perspiciatis, nesciunt laudantium ut mollitia earum, distinctio deserunt iste eaque sapiente quae quibusdam. Et nostrum quo sapiente voluptas.</p>
            </div>
        </div>
        <br>
    <?php endforeach;?>
</main>

<?php require '../components/footer.php'?>