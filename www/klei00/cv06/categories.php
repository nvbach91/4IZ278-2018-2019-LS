<?php require __DIR__.'/database/CategoriesDB.php'; ?>

<?php

$categoriesDB = new CategoriesDB('categories');
$categories = $categoriesDB->fetchAll();

?>

<div class="list-group">
    <?php foreach($categories as $category): ?>
        <a href="#" class="list-group-item"><?php echo $category['name'] ?></a>
    <?php endforeach; ?>
</div>