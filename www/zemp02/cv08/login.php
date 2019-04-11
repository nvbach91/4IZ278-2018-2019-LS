<?php
session_start();
require './Header.php';
require './Navbar.php';

if ('POST' == $_SERVER['REQUEST_METHOD']) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    require_once './ProductsDB.php';
    $db = new ProductsDB();
    $storedUser = $db->fetchUserByEmail($email);
    if (password_verify($password, $storedUser['password'])) {

        $_SESSION['userID'] = $storedUser['id'];
        $_SESSION['userEmail'] = $storedUser['email'];
        header('Location: index.php');

    } else {
        echo('Invalid user or password');
    }


}


?>

    <main class="container">
        <div clas="row justify-content-center">
            <div class="col-md-4 offset-md-4 text-center align-self-center col-centered">
                <h2 class="my-4"> Login Page</h2>
                <form method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                    <div class="row justify-content-center my-2">
                        <input name="email">
                    </div>
                    <div class="row justify-content-center my-2">
                        <input name="password">
                    </div>
                    <button class="btn btn-primary float-center mb-2" type="submit">Log in</button>
                </form>
            </div>
        </div>

        <div class ="btn btn-secondary col-md-4 offset-md-4 mb-2">
            <a href="./register.php" class="text-light">Create new account.</a>
        </div>
    </main>

<?php
require './Footer.php'
?>