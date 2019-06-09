<?php
require 'db.php';
require 'manager_require.php';

$books = $booksDB->fetchAllOrdered('title');

$messages=[];

if(isset($_GET['stock'])){
    array_push($messages, 'Stav zásob byl změněn');
}
?>

<?php require './components/header.php'; ?>

<main class="container">    
    <?php if(count($messages)): ?>
        <div class="alert alert-success">
                <?php foreach($messages as $message): ?>
                <p><?php echo $message; ?></p>
                <?php endforeach ?>
        </div>
    <?php endif ?>
    <h1>Zásoby na skladě</h1>
    <br>
    <a class="btn btn-dark" href="change_stock.php">Změna zásob</a>
    <br>
    <br>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Název</th>
                <th scope="col">Autor</th>
                <th scope="col">Na skladě</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($books as $book): ?>
            <tr>
                <td><?php echo @$book['title'];?></td>
                <td><?php echo @$book['author'];?></td>
                <td><?php echo @$book['in_stock'].' ks';?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</main>

<?php require './components/footer.php'; ?>