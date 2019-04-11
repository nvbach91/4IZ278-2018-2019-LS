<?php
require './Header.php';
require './Navbar.php';

if (isset($_POST['name'])){
    setcookie('name',$_POST['name'],time()+3600);
    header('Location: index.php');
    die();
}
?>

<main class="container">
    <div clas="row justify-content-center">
        <div class="col-md-4 offset-md-4 text-center align-self-center col-centered">
            <h2 class = "my-4"> Login Page</h2>
            <form method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                <div class="row justify-content-center my-2">
                    <input name="name"">
                </div>
                <button class="btn btn-primary float-center mb-2" type="submit">Log in</button>
            </form>
        </div>
    </div>

</main>

<?php
require './Footer.php'
?>