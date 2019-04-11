<?php
require './Header.php';
require './Navbar.php';

if (!empty($_POST)){

    require_once './ProductsDB.php';
    $productsDB = new ProductsDB();

    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    $productsDB->insertGood($name,$description,$price);


    header('Location: index.php');
    die();
}
?>

    <main class="container">
        <div clas="row justify-content-center">
            <div class="col-md-4 offset-md-4 text-center align-self-center col-centered">
                <h2 class = "my-4"> Login Page</h2>
                <form method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                    <div class="form-group">
                        <label>Name:</label>
                        <input class="form-control" name="name">
                    </div>
                    <div class="form-group">
                        <label>Description:</label>
                        <input class="form-control" name="description">
                    </div>
                    <div class="form-group">
                        <label>Price:</label>
                        <input class="form-control" name="price">
                    </div>
                    <button class="btn btn-primary float-center mb-2" type="submit">Log in</button>
                </form>
            </div>
        </div>

    </main>

<?php
require './Footer.php'
?>