<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['user_privilege'] < 2) {
    header('Location: signin.php');
    die();
}

$stmt = $db->prepare('SELECT * FROM users WHERE id = :id LIMIT 1');

$stmt->execute([
    'id' => $_SESSION['user_id']
]);

$current_user = $stmt->fetchAll()[0];

if (!$current_user) {
    session_destroy();
    header('Location: signin.php');
    die();
}