<?php

require 'db.php';

require 'user_required.php';


if (isset($_GET['offset'])) {
    $offset = (int)$_GET['offset'];
} else {
    $offset = 0;
}

$count = $db->query('SELECT COUNT(id) FROM goods')->fetchColumn();

$stmt = $db->prepare('SELECT * FROM goods');

$stmt = $db->prepare('SELECT * FROM goods ORDER BY id DESC LIMIT 10 OFFSET ?');
$stmt->bindValue(1, $offset, PDO::PARAM_INT);
$stmt->execute();
$goods = $stmt->fetchAll();
?>

<?php require __DIR__ . '/incl/header.php'; ?>
<main class="container">
    <h1>Mango index</h1>
    Total mango count: <?php echo $count ?>
    <?php if ($_SESSION['user_privilege'] > 1): ?>
        <br/><br/>
        <a href="new.php">Add new mango</a>
    <?php endif; ?>
    <br/><br/>
    <?php if ($count) { ?>
        <?php if (isset($_GET['state'])): ?>
            <div class="alert alert-success">
                <?php if ($_GET['state'] === 'edit') {
                    echo 'Edit ';
                } else if ($_GET['state'] === 'delete') {
                    echo 'Delete ';
                } ?>
                Successful!
            </div>
        <?php endif; ?>
        <div class="products">
            <?php foreach ($goods as $row): ?>
                <div class="card product" style="width: calc(100%/3)">
                    <img class="card-img-top" src="https://via.placeholder.com/300x150" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $row['name'] ?></h5>
                        <div class="card-subtitle"><?php echo $row['price'] ?></div>
                        <div class="card-text"><?php echo $row['description'] ?></div>
                        <a class="card-link" href='./buy.php?id=<?php echo $row['id'] ?>'>Buy</a>
                        <?php
                        if ($_SESSION['user_privilege'] > 1):
                            ?>
                            <a class="card-link" href='./update.php?id=<?php echo $row['id'] ?>'>Edit</a>
                            <a class="card-link" href='./delete.php?id=<?php echo $row['id'] ?>'>Delete</a>
                        <?php
                        endif;
                        ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="pagination">
            <?php for ($i = 1; $i < ceil($count / 10); $i++) { ?>
                <a class="<?php echo $offset / 10 + 1 == $i ? "active" : ""; ?>"
                   href="./index.php?offset=<?php echo ($i - 1) * 10; ?>"><?php echo $i; ?> </a>
            <?php } ?>
        </div>

    <?php } ?>
</main>

<?php require __DIR__ . '/incl/footer.php'; ?>

