<?php
require 'user_require.php';

if((int)$currentUser[0]['role'] < 2 ){
    die('Přístup odepřen. Nemáte dostatečná práva.');
}
?>