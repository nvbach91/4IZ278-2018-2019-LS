<?php
// začnu session a připojím se k databázi, zároveň nahraju třídy
@session_start();
require_once "./include/connect.php";
require_once "include/functions/csrf.php";

// když není žádný uživatel přihlášen
if (!isset($_SESSION['user_id'])) {
    // hodím ho na homepage
    if (basename($_SERVER['PHP_SELF']) != "index.php") {
        header("location: index");
    }
} else {
    // když je přihlášen, identifikuju si ho do proměnné $user_id - tuto proměnnou používám velice často
    $user_id = new User();
    $user_id->id = $_SESSION['user_id'];
    $user_id->user_data();
}
?>
<meta charset="UTF-8">
<link rel="stylesheet" href="assets/css/css.css">
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
    integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.4.1.min.js"
    integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script type="text/javascript" src="assets/js/js.js"></script>
<link rel="shortcut icon" type="image/png" href="assets/img/favicon.ico" />


<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo isset($title) ? "$title | Prázdninovač" : "Prázninovač"; ?></title>