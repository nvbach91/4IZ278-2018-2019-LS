<?php
session_start();

require 'db.php';
$submittedForm = $_SERVER['REQUEST_METHOD'] == 'POST';
// $submittedForm = !empty($_POST);

if ($submittedForm) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Please use a valid email';
    }

    if (strlen($password) < 3) {
        $errors['password'] = 'Please enter more than 3 characters for your password';
    }
    if (empty($errors)) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $db->prepare('Insert Into users(email, password, privilege) Values (:email, :password, 1)');

        $stmt->execute([
            'email' => $email,
            'password' => $hashedPassword
        ]);

        header('Location: signin.php');
    }
}
?>
<?php require './incl/header.php'; ?>
    <main class="container">
        <h1>PHP Shopping App</h1>
        <h2>New Signup</h2>
        <?php if ($submittedForm && !empty($errors)): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php echo implode('<br>', array_values($errors)); ?>
            </div>
        <?php endif; ?>
        <form novalidate="novalidate" class="form-signin" method="POST">
            <div class="form-label-group">
                <label for="email">Email address</label>
                <input type="email" name="email" class="form-control" placeholder="Email address"  autofocus>
            </div>
            <div class="form-label-group">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Password" >
            </div>
            <br>
            <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Creat account</button>
        </form>
    </main>
    <div style="margin-bottom: 600px"></div>
<?php require './incl/footer.php'; ?>