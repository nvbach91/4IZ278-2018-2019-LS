<?php
require './header.php';
require './function.php';
$errors = [];
if (!empty($_POST)) {


    $name = $_POST['name'];
    $email = $_POST['email'];
    $password= $_POST['password'];
    $confirmPassword= $_POST['confirmPassword'];
    if (!$name) {
        array_push($errors, 'Please enter your name.');
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, 'Please enter your email.');
    }
    if (!$password) {
        array_push($errors, 'Please enter your password');
    }else if (!$password==$confirmPassword) {
        array_push($errors, 'Your passwords do not match.');
    }
    $person = [
        'name' => $name,
        'email' => $email,
        'password' => $password
    ];


    if (empty($errors)) {
        $check = registerNewUser($person);
        if(!$check){
            array_push($errors,'This user already exists');
        }
    }
}
?>


<main class="container">

    <h1 class="text-center mt-4">Insert your details.</h1>
    <h2 class="text-center">Fill in the blanks.</h2>
    <form class="form-signup" method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
        <?php
        if (!empty($errors)) {
            foreach ($errors as $error) {
                echo '<div class="alert alert-warning" role="alert">' . $error . '</div>';
            }
        }
        ?>
        <div class="form-group">
            <label>Name:</label>
            <input class="form-control" name="name" value="<?php echo isset($name) ? ($name) : ''; ?>">
        </div>
        <div class="form-group">
            <label>Email:</label>
            <input class="form-control" name="email" value="<?php echo isset($email) ? ($email) : ''; ?>">
        </div>
        <div class="form-group">
            <label>Password:</label>
            <input class="form-control" name="password">
        </div>
        <div class="form-group">
            <label>Confirm password:</label>
            <input class="form-control" name="confirmPassword">
        </div>
        <a class="btn btn-primary float-left" href="<?php echo $_SERVER['PHP_SELF'] ?>">Cancel</a>
        <button class="btn btn-primary float-right" type="submit">Submit</button>
    </form>

</main>
<?php
require './footer.php'; ?>
