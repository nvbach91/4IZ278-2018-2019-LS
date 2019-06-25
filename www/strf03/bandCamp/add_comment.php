<?php
require 'db.php';

require 'logged_in_required.php';

require 'user_required.php';

if(!isset($_POST['text'])){
    redirect();
}
$text= test_input($_POST['text']);
$user_id = $_SESSION['user_id'];
$article_id = $_GET['article_id'];

$stmt = $db->prepare('SELECT * FROM articles WHERE article_id =?');
$stmt->execute([$article_id]);
$articles = $stmt->fetchAll();

if(!is_in_array($articles, 'article_id', $article_id)){
   redirect();
}


$stmt = $db->prepare('Insert Into comments (text, users_user_id, articles_article_id) Values (:text, :users_user_id, :articles_article_id)');

$stmt->execute([
    'text' => $text,
    'users_user_id' => $user_id,
    'articles_article_id' => $article_id
]);

header('Location: band_profile.php?band_id='.$_GET['band_id']);


