<?php
session_start();
require './Header.php';
require './Navbar.php';

if ('POST' == $_SERVER['REQUEST_METHOD']) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $hashedPswd = password_hash($password,PASSWORD_DEFAULT);

    require_once './ProductsDB.php';
    $db = new ProductsDB();
    $id = $db->insertUser($email,$hashedPswd);
    $_SESSION['userID'] = $id;
    $_SESSION['userEmail'] = $email;
    header('Location: index.php');

}


?>

    <main class="container">
        <div clas="row justify-content-center">
            <div class="col-md-4 offset-md-4 text-center align-self-center col-centered">
                <h2 class="my-4"> Create new User</h2>
                <form method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                    <div class="row justify-content-center my-2" >
                        <input name="email" placeholder="Email">
                    </div>
                    <div class="row justify-content-center my-2">
                        <input name="password" placeholder="Password">
                    </div>
                    <button class="btn btn-primary float-center mb-2" type="submit">Log in</button>
                </form>
            </div>
        </div>

    </main>

<?php
require './Footer.php'
?>