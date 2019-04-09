<?php
require 'db.php';
require 'manager_required.php';
$id=$_GET['id'];

$stmt = $db->prepare("SELECT * FROM goods where id=?");
$stmt->bindValue(1, $id, PDO::PARAM_INT);
$stmt->execute();
$row = $stmt->fetch();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $price = $_POST["price"];
    $description = $_POST["description"];

    $stmt = $db->prepare("UPDATE goods SET name=?, description=?,price=? WHERE id = ?");
    $stmt->bindValue(1, $name, PDO::PARAM_STR);
    $stmt->bindValue(2, $description, PDO::PARAM_STR);
    $stmt->bindValue(3, $price, PDO::PARAM_INT);
    $stmt->bindValue(4, $id, PDO::PARAM_INT);
    $stmt->execute();
    header('Location: index.php?state=edit');
}

?>

<?php require __DIR__ . '/incl/header.php'; ?>
<main class="container">
    <h1>Update Mango!</h1>
    <form method="POST">
        <div class="form-group">
            <label for="asdf">Name of Mango:</label>
            <input type="name" name="name" class="form-control" id="name" aria-describedby="nameHelp"
                   placeholder="Enter name of Mango" value="<?php echo @$row['name']; ?>">
        </div>
        <div class="form-group">
            <label for="price">Price of mango:</label>
            <input type="price" class="form-control" name="price" id="name" aria-describedby="priceHelp"
                   placeholder="Price" value="<?php echo @$row['price'] ?>">
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea name="description" class="form-control" rows="5" id="description"><?php echo @$row['description'] ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</main>
<div style="margin-bottom: 300px"></div>


<?php require './incl/footer.php' ?>
