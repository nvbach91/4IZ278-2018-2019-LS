<?php require 'database.php'; ?>
<?php

$usersDB = new UsersDB();
$user = $usersDB->fetch(['email' => 'nathan@drake.net']);
var_dump($user);

?>