<?php

require 'db.php';

require 'admin_required.php';

$stmt = $db->prepare("SELECT * FROM users");

$stmt ->execute();
$users = $stmt->fetchAll();

?>
<?php require __DIR__ . '/incl/header.php' ?>
<table class="table table-hover">
    <thead class="thead-dark">
    <tr>
        <th scope="col">#</th>
        <th scope="col">Email</th>
        <th scope="col">Privilege</th>
    </tr>
    </thead>
    <tbody>
<?php
    foreach ($users as $user) {
        echo '<tr>';
        echo '<td>' . $user['id'] . '</td>';
        echo '<td>' . $user['email'] . '</td>';
        echo '<td>' . $user['privilege'] . '</td>';
        echo '</tr>';
    }
    ?>
    </tbody>
</table>
<div style="margin-bottom: 300px"></div>
<?php require __DIR__ . '/incl/footer.php';
?>


