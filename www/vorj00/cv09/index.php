<?php

require_once __DIR__ . '/vendor/autoload.php'; // change path as needed
require __DIR__ . '/config.php';

$fb = new \Facebook\Facebook(CONFIG_FACEBOOK);

$helper = $fb->getRedirectLoginHelper();
$permissions = ['email']; // Optional permissions
$loginUrl = $helper->getLoginUrl('http://' . 'vcap.me' . '/webapps/www/vorj00/cv09' . '/fb-login-callback.php', $permissions);

?>

<a href="<?php echo $loginUrl; ?>">FB login</a>

<pre><?php echo $loginUrl; ?></pre>