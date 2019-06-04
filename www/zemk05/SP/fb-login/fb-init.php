<?php 

require 'vendor/autoload.php';

$fb = new Facebook\Facebook([
    'app_id' => '348564142525844',
    'app_secret' => '900b38a8d0088c328a4498ae33c61e00',
    'default_graph_version' => 'v2.10'
]);

$helper = $fb->getRedirectLoginHelper();
$loginUrl = $helper->getLoginUrl("http://eso.vse.cz/~zemk05/SP/fb-login");

?>