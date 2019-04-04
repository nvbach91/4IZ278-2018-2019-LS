<?php

$host = "localhost";
$username = "";
$password = "";
$database = "test";

$pdo = new PDO(
    /* DSN */'mysql:host=' . $host . ';dbname=' . $database . ';charset=utf8mb4',
    /* USR */ $username,
    /* PWD */ $password
);

// NSFW
//$pdo->query('SELECT * FROM products');

// prepared statement
$sqlTemplate = '
    SELECT * FROM products
    WHERE
        name = :name &&
        price > :price';
$statement = $pdo->prepare($sqlTemplate);
$statement->execute([
    //'id' => 7
    'name' => 'Ataulfo',
    'price' => 50
    ]);

$results = $statement->fetchAll(PDO::FETCH_ASSOC);
//$statement->fetch();

?>

<pre>
<?php //var_dump($results);?>
</pre>

<div>
    <?php foreach ($results as $result): ?>
    <div><?php echo $result['name']; ?></div>
    <div>€<?php echo $result['price']; ?></div>
    <img src="<?php echo $result['img']; ?>" /></div>
    <?php endforeach;?>
</div>