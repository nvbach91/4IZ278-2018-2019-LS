<?php
require __DIR__ . '/utils/functions.php';

if (isset($_GET['email'])) {
    $email = $_GET['email'];
    $user = fetchUsers($email);
}

if (!$user) {
    header('Location: registration.php');
}

?>

<?php require './components/header.php'?>

<!-- kopíruju HTML od tebe -->
<main class="container">
    <br>
    <em>Zkopíroval jsem jen HTML, PHP ne</em>
    <h1 class="text-center">Profile</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title"><?php echo $user['name']; ?></h5>
            <h6 class="card-subtitle mb-2 text-muted"><?php echo $user['email']; ?></h6>
            <p class="card-text">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Totam sed mollitia, quasi tempore vitae voluptatem maiores omnis dolorum quo nam fugiat sapiente? Est, necessitatibus sint? Quod saepe ab inventore quaerat?</p>
        </div>
    </div>
</main>

<?php require './components/footer.php'?>