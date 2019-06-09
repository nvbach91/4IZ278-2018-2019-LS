<?php
// převzato z https://php.vrana.cz/automaticka-obrana-proti-csrf.php a https://stackoverflow.com/questions/6287903/how-to-properly-add-csrf-token-using-php

if (empty($_SESSION['token'])) {
    $_SESSION['token'] = bin2hex(random_bytes(32));
}

$token = $_SESSION['token'];
