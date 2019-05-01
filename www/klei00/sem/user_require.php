<?php
session_start();

$userID = $_SESSION['userID'];
if (!isset($userID)) {
    header('Location: login.php');
    die();
}
$currentUser = $usersDB->fetch('user_id', $userID);
if (!$currentUser) {
    session_destroy();
    header('Location: index.php');
    die();
}
?>