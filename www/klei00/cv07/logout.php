<?php

session_start();

unset($_SESSION['cart']);
setcookie('name', '', time());
header('Location: index.php');


?>