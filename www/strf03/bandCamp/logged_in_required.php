<?php
session_start();
$current_user = array();
$current_band = array();
if (isset($_SESSION['user_id'])) {
    $stmt = $db->prepare('SELECT * FROM users WHERE user_id = :user_id LIMIT 1');
    $stmt->execute([
        'user_id' => $_SESSION['user_id']
    ]);
    $current_user = $stmt->fetchAll()[0];
} else if (isset($_SESSION['band_id'])) {
    $stmt = $db->prepare('SELECT * FROM bands WHERE band_id = :band_id LIMIT 1');
    $stmt->execute([
        'band_id' => $_SESSION['band_id']
    ]);
    $current_band = $stmt->fetchAll()[0];
} else {
    header('Location: index.php');
    die();
}

if (!$current_user && !$current_band) {
    session_destroy();
    header('Location: index.php');
    die();
}
