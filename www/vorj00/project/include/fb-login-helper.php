<?php

require_once __DIR__ . '/../vendor/autoload.php'; // change path as needed
require __DIR__ . '/fb-config.php';

$fb = new \Facebook\Facebook(CONFIG_FACEBOOK);

$helper = $fb->getRedirectLoginHelper();
$permissions = ['email']; // Optional permissions
//$FBloginUrl = $helper->getLoginUrl('https://' . 'vcap.me' . '/webapps/www/vorj00/project' . '/fb-login-callback.php', $permissions);
$FBloginUrl = $helper->getLoginUrl('https://' . 'eso.vse.cz' . '/~vorj00/project' . '/fb-login-callback.php', $permissions);