<?php
session_start();
require 'db.php';
$submittedForm = $_SERVER['REQUEST_METHOD'] == 'POST';
if ($submittedForm) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $db->prepare('SELECT * FROM users WHERE email = :email LIMIT 1');
    $stmt->execute([
        'email' => $email,
    ]);

    $existing_user = @$stmt->fetchAll()[0];
    if (password_verify($password, $existing_user['password'])) {
        $_SESSION['user_id'] = $existing_user['id'];
        $_SESSION['user_email'] = $existing_user['email'];
        $_SESSION['user_privilege'] = $existing_user['privilege'];
        header('Location: index.php');
    } else {
        header('Location: signin.php?authentication=failed');

    }
}
?>

<?php require __DIR__ . '/incl/header.php' ?>
<main class="container">
    <h1>PHP Shopping App</h1>
    <h2>Sign in</h2>
    <?php if (@$_GET['authentication'] === 'failed'): ?>
        <div class="alert alert-danger alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <?php echo 'Email and/or password is incorrect'; ?>
        </div>
    <?php endif; ?>
    <form class="form-signin" method="POST">
        <div class="form-label-group">
            <label for="email">Email address</label>
            <input type="email" name="email" class="form-control" placeholder="Email address" required autofocus>
        </div>

        <div class="form-label-group">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control" placeholder="Password" required>
        </div>
        <br>
        <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Sign in</button>
    </form>
    <a href="signup.php">Don't have an account yet? Go to sign up!</a>
</main>

<div style="margin-bottom: 600px"></div>

<?php require __DIR__ . '/incl/footer.php' ?>
