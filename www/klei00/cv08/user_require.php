<?php
session_start();

$userID = $_SESSION['userID'];
if (!isset($userID)) {
    header('Location: login.php');
    die();
}
$current_user = $usersDB->fetch('id', $userID);
if (!$current_user) {
    session_destroy();
    header('Location: index.php');
    die();
}
?>