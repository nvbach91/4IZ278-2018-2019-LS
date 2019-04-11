<?php
require './header.php';
require './function.php';
?>

<?php
$errors = [];
if (!empty($_GET)) {
    $email = $_GET['email'];
}
if(!empty($_POST)){

    if (!isset($_POST['email'])) {
        array_push($errors, 'Please enter your email.');
    }
    if (!isset($_POST['password'])) {
        array_push($errors, 'Please enter your password');
    }

    if(empty($errors)) {
        authenticate($_POST['email'], $_POST['password']);
    }else {
        foreach ($errors as $error) {
            echo '<div class="alert alert-warning" role="alert">' . $error . '</div>';
        }
    }
}
?>

    <main class="container">
        <div clas="row justify-content-centr">
            <div class="col-md-4 offset-md-4 text-center align-self-center col-centered">
                <h2 class = "my-4"> Login Page</h2>
                <form method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                    <div class="row justify-content-center my-2">
                        <input name="email" value="<?php echo @$email; ?>">
                    </div>
                    <div class="row justify-content-center my-2">
                        <input name="password" value="<?php echo @$password; ?>">
                    </div>
                    <button class="btn btn-primary float-right" type="submit">Log in</button>
                </form>
            </div>
        </div>

    </main>


<?php require './footer.php'; ?>