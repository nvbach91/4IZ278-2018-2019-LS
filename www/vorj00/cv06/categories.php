<?php
require __DIR__ . '/db/CategoriesDB.php';

$categories = new CategoriesDB();

$results = $categories->fetchAll();
?>

<div class="list-group">
    <?php foreach($results as $result): ?>
        <a href="#" class="list-group-item"><?php echo $result['name']; ?></a>
    <?php endforeach; ?>
</div>