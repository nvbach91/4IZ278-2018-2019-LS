<?php 
require 'db.php';
require 'user_req.php';

$email = @$_SESSION['email'];

?>

<?php require __DIR__ . '/incl/header.php'; ?>

<?php require __DIR__ . '/incl/navbar.php'; ?>

<main class="container">
    <br>
    <h1 class="text-center">Profil uživatele</h1>
    <form method="POST">
        <div class="card">
            <div class="card-body">
                <h5 class="card-subtitle mb-2 text-muted"><?php echo $email?></h6>
                <a class="text-dark" href="./index.php">Zpět na hlavní stránku</a>
                <br>
                <a class="text-dark" href="./profile_settings.php">Nastavení profilu</a>
            </div>
            
        </div>
    </form>
</main>

<?php require __DIR__ . '/incl/footer.php'; ?>
