<?php

require 'db.php';
require 'user_required.php';

$id = $_POST['id'];
if (($key = array_search($id, $_SESSION['cart'])) !== false){
    unset($_SESSION['cart'][$key]);}
else {
    die("Unable to find goods");
}

header('Location: cart.php');
