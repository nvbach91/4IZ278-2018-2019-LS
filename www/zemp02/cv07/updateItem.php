<?php
require './Header.php';
require './Navbar.php';


require_once './ProductsDB.php';
$productsDB = new ProductsDB();
if(empty($_POST)){
    header('Location: goodsSetting.php');
    die();
}
if(!empty($_POST['name'])){

    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

$productsDB->updateGood($id,$name,$description,$price);
    header('Location: goodsSetting.php');
    die();
}

if (!empty($_POST['id'])) {

    $id = $_POST['id'];
    $products = $productsDB->fetchProduct($id);
    $product=$products[0];
}

?>

    <main class="container">
        <div clas="row justify-content-center">
            <div class="col-md-4 offset-md-4 text-center align-self-center col-centered">
                <h2 class = "my-4"> Login Page</h2>
                <form method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                    <input type="hidden" value="<?= $id?>" name="id" />
                    <div class="form-group">
                        <label>Name:</label>
                        <input class="form-control" name="name" value = "<?= $product['name']?>">
                    </div>
                    <div class="form-group">
                        <label>Description:</label>
                        <input class="form-control" name="description" value = "<?= $product['description']?>">
                    </div>
                    <div class="form-group">
                        <label>Price:</label>
                        <input class="form-control" name="price" value = "<?= $product['price']?>">
                    </div>
                    <button class="btn btn-primary float-center mb-2" type="submit">Log in</button>
                </form>
            </div>
        </div>

    </main>

<?php
require './Footer.php'
?>