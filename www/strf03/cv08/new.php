<?php require __DIR__ . '/incl/header.php'; ?>

<?php
require 'db.php';
require 'manager_required.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $price = $_POST["price"];
    $description = $_POST["description"];

    $stmt = $db->prepare("INSERT INTO goods (name, description, price) VALUES (:name, :description, :price)");
    $stmt->execute([
        'name' => $name,
        'description' => $description,
        'price' => $price
    ]);
    header('Location: index.php');
}

?>
<main class="container">
    <h1>Add new Mango!</h1>
    <form method="POST">
        <div class="form-group">
            <label for="asdf">Name of Mango:</label>
            <input type="name" name="name" class="form-control" id="name" aria-describedby="nameHelp"
                   placeholder="Enter name of Mango">
        </div>
        <div class="form-group">
            <label for="price">Price of mango:</label>
            <input type="price" class="form-control" name="price" id="name" aria-describedby="priceHelp"
                   placeholder="Price">
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea name="description" class="form-control" rows="5" id="description"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</main>
<div style="margin-bottom: 300px"></div>


<?php require './incl/footer.php' ?>
