<?php require './components/header.php'?>

<?php
require __DIR__ . '/utils/functions.php';

$errors = [];
$usersList = file('./database/users.db');
$registeredEmail = false;

if (!empty($_POST)) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $passwordConfirm = $_POST['passwordConfirm'];

    if (!$name) {
        array_push($errors, 'Please, please, enter your name');
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, 'Please use a valid email');
    }

    if (!$password) {
        array_push($errors, 'Please, please, enter your password');
    } else {
        if ($password !== $passwordConfirm) {
            array_push($errors, 'Please, please, make both passwords the same');
        }
    }

    if (!$errors) {
        $registerSuccess = registerNewUser($name, $email, $password);

        if (!$registerSuccess) {
            array_push($errors, 'This user already exists');
        }
    }
}

?>

<main class="container">
    <form class="form-signup" method="POST" action="<?php $_SERVER['PHP_SELF']?>">
        <?php if (count($errors)): ?>
        <div class="alert alert-danger">
            <?php foreach ($errors as $error): ?>
            <span><?php echo $error; ?></span><br>
            <?php endforeach;?>
        </div>
        <?php endif;?>
        <div class="form-group">
            <label>Name*</label>
            <input class="form-control" name="name" value="<?php echo @$name; ?>">
        </div>
        <div class="form-group">
            <label>Email*</label>
            <input class="form-control" name="email" type="email" value="<?php echo @$email; ?>">
        </div>
        <div class="form-group">
            <label>Password*</label>
            <input class="form-control" name="password" type="password" value="<?php echo @$password; ?>">
        </div>
        <div class="form-group">
            <label>Confirm password*</label>
            <input class="form-control" name="passwordConfirm" type="password" value="<?php echo @$passwordConfirm; ?>">
        </div>
        <button class="btn btn-primary" type="submit">Submit</button>
    </form>
</main>

<?php require './components/footer.php'?>