<?php
require_once __DIR__.'/facebook/vendor/autoload.php';
session_start();

if (!isset($_SESSION['userID']) && !isset($_SESSION['fb'])) {
    header('Location: login.php');
    die();
}

if(isset($_SESSION['userID']) && !isset($_SESSION['fb'])){
    $currentUser = $usersDB->fetch('user_id', $_SESSION['userID']);
    if (!$currentUser) {
        session_destroy();
        header('Location: index.php');
        die();
    }
}else{
    $accessToken = $_SESSION['fb'];
    $fb = new \Facebook\Facebook([
        'app_id' => '353829385257639',
        'app_secret' => '5823485577286f1900e22da50cbe773e',
        'default_graph_version' => 'v2.10',
        'default_access_token' => $accessToken
    ]);
    try {
        $user = $fb->get('/me?fields=email,name', $accessToken)->getGraphUser();
    } catch(\Facebook\Exceptions\FacebookResponseException $e) {
        echo 'Graph returned an error: ' . $e->getMessage();
        exit;
    } catch(\Facebook\Exceptions\FacebookSDKException $e) {
        echo 'Facebook SDK returned an error: ' . $e->getMessage();
        exit;
    }
    $currentUser = $usersDB->fetch('email', $user['email']);
    if (!$currentUser) {
        session_destroy();
        header('Location: index.php');
        die();
    }
    $_SESSION['userID'] = $currentUser[0]['user_id'];
    $_SESSION['email'] = $currentUser[0]['email'];
    $_SESSION['role'] = $currentUser[0]['role'];
}
?>