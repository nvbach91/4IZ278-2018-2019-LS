<?php 
session_start();

$users_id= $_SESSION['id'];
if (!isset($users_id)) {
    header('Location: login.php');
    die();
}
 $logged_user= $usersDB->fetchBy('users_id', $users_id);
if (!$logged_user) {
    session_destroy();
    header('Location: index.php');
    die();
}
?>
