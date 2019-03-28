<?php
require __DIR__ . '/utils/functions.php';

$successes = [];
$errors = [];
$records = [];

if (isset($_GET['email'])) {
    $email = $_GET['email'];
    array_push($successes, 'Registration successful');
}

if (!empty($_POST)) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $isAuthenticated = authenticate($email, $password);

    if (!$isAuthenticated) {
        array_push($errors, 'Bad credentials');
    }
}

?>

<?php require './components/header.php'?>

<main class="container">
    <h1>Login</h1>
    <form class="form-signup" method="POST" action="login.php">
        <h2>Login form</h2>
        <?php if (count($successes)): ?>
        <div class="alert alert-success">
            <?php foreach ($successes as $success): ?>
            <span><?php echo $success; ?></span><br>
            <?php endforeach;?>
        </div>
        <?php endif;?>
        <?php if (count($errors)): ?>
        <div class="alert alert-danger">
            <?php foreach ($errors as $error): ?>
            <span><?php echo $error; ?></span><br>
            <?php endforeach;?>
        </div>
        <?php endif;?>
        <div class="form-group">
            <label>Email*</label>
            <input class="form-control" name="email" type="email" value="<?php echo @$email; ?>">
        </div>
        <div class="form-group">
            <label>Password*</label>
            <input class="form-control" name="password" type="password" value="<?php echo @$password; ?>">
        </div>
        <button class="btn btn-primary" type="submit">Submit</button>
    </form>
</main>

<?php require './components/footer.php'?>