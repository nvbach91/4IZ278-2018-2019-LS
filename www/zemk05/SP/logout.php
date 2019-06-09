<?php

session_start();
session_destroy();
setcookie('email', '', time());
header('Location: index.php');

?>