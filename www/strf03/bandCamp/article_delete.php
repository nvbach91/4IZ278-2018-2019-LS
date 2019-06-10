<?php
require 'db.php';
require 'logged_in_required.php';
require 'band_required.php';


$band_id = $_SESSION['band_id'];
$article_id = $_GET['article_id'];

$stmt = $db->prepare("SELECT * FROM articles WHERE article_id = ? LIMIT 1");
$stmt->execute([$article_id]);
$article= $stmt->fetch();
if($article['bands_band_id'] != $band_id){
    header('Location: band_profile.php?band_id='.$_SESSION['band_id']);
}

$stmt = $db->prepare('DELETE FROM articles WHERE article_id=?');
$stmt->execute([$article_id]);

header('Location: band_profile.php?band_id='.$_SESSION['band_id']);