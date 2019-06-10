<?php
$db = new PDO(
    'mysql:host=localhost;dbname=bandcamp;charset=utf8mb4',
    'root',
    'root'
);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

require __DIR__ . '/config/config.php';











