<?php
session_start();
require 'db.php';

if (isset($_SESSION['band_id'])) {
    header('Location: band_profile.php?band_id=' . $_SESSION['band_id']);
}
if (isset($_SESSION['user_id'])) {
    header('Location: user_profile.php?user_id=' . $_SESSION['user_id']);
}
$submittedForm = $_SERVER['REQUEST_METHOD'] == 'POST';

if ($submittedForm) {
    $email = test_input($_POST['email']);
    $password = test_input($_POST['password']);


    $stmt = $db->prepare('SELECT * FROM users WHERE email = :email LIMIT 1');
    $stmt->execute([
        'email' => $email
    ]);
    $existing_user = @$stmt->fetchAll()[0];

    if (isset($existing_user)) {
        if (password_verify($password, $existing_user['password'])) {
            $_SESSION['user_id'] = $existing_user['user_id'];
            $_SESSION['email'] = $existing_user['email'];
            header('Location: user_profile.php?user_id=' . $_SESSION['user_id']);
        } else {
            $errors['invalid'] = 'Nesprávný email nebo heslo';
        }
    }
    //-------------------

    $stmt = $db->prepare('SELECT * FROM bands WHERE email = :email LIMIT 1');
    $stmt->execute([
        'email' => $email
    ]);

    $existing_band = @$stmt->fetchAll()[0];

    if (password_verify($password, $existing_band['password'])) {
        $_SESSION['band_id'] = $existing_band['band_id'];
        $_SESSION['email'] = $existing_band['email'];
        header('Location: band_profile.php?band_id=' . $_SESSION['band_id']);
    } else {
        $errors['invalid'] = 'Nesprávný email nebo heslo';
    }


    // todo algoritmus

}
?>
<?php require __DIR__ . '/incl/header.php' ?>
    <div class="bg">
    <main class="container">
        <h4 class="mb-3">Přihlásit uživatele</h4>

        <?php if (isset($_GET['registration'])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Registrace úspěšná</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>
        <?php if ($submittedForm && !empty($errors)): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php echo implode('<br>', array_values($errors)); ?>
            </div>
        <?php endif; ?>
        <form method="POST">

            <div class="mb-3">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" placeholder="Email" value="<?php echo @$email; ?>" id="email">
            </div>

            <div class="mb-3">
                <label for="password">Heslo</label>
                <input name="password" type="password" class="form-control" placeholder="Heslo" id="password">
            </div>


            <button class="btn btn-lg btn-dark btn-block text-uppercase" type="submit">Přihlásit se</button>
        </form>
        <b><a href="registration.php">Nemáš účet? Registrace!</a></b>
    </main>
    </div>

    <div style="margin-bottom: 300px"></div>


<?php require __DIR__ . '/incl/footer.php' ?>