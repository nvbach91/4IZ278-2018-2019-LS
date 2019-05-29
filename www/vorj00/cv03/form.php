<?php require './components/header.php'?>

<?php
//var_dump($_POST);
$errors = [];

if (!empty($_POST)) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $avatar = $_POST['avatar'];

    if (!$name) {
        array_push($errors, 'Please, please, enter your name');
    }

    if (!$email) {
        array_push($errors, 'Please, please, enter your e-mail');
    } else {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            array_push($errors, 'Please use a valid email');
        }
    }

    if (!$phone) {
        array_push($errors, 'Please, please, enter your phone');
    }

    if (!preg_match('/^[0-9]{9}$/', $phone) && $phone) {
        array_push($errors, 'Please, please, enter your phone in correct format');
    }

    if (!$avatar) {
        array_push($errors, 'Please, please, upload your avatar');
    }
    header('Location: login.php?email=' . $email);
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
            <input class="form-control" name="email" value="<?php echo @$email; ?>">
        </div>
        <div class="form-group">
            <label>Phone*</label>
            <input class="form-control" name="phone" value="<?php echo @$phone; ?>">
        </div>
        <div class="form-group">
            <label>Avatar URL*</label>
            <input class="form-control" name="avatar" value="<?php echo @$avatar; ?>">
        </div>
        <button class="btn btn-primary" type="submit">Submit</button>
    </form>
</main>

<?php require './components/footer.php'?>