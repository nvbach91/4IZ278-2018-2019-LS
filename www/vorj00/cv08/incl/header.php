<?php

session_start();

require __DIR__ . '/../db/UsersDB.php';

$userId = @$_SESSION['user_id'];

$isPageAllowed = false;

$allowedAdresses = ['cv08', 'index.php', 'login.php', 'signup.php', 'world-clock.php'];
$restrictedAddresses = ['create-item.php', 'edit-item.php', 'remove-item.php'];
$superRestrictedAddresses = ['users.php'];

foreach ($allowedAdresses as $address) {
    if ($address === basename($_SERVER["REQUEST_URI"])) {
        $isPageAllowed = true;
        break;
    }
}

if (isset($userId)) {
    $usersDB = new UsersDB;
    $userAuthority = $usersDB->getAuthority($userId);

    $isPageAllowed = true;

    if ($userAuthority === 1) {
        foreach ($restrictedAddresses as $address) {
            if ($address === strtok(basename($_SERVER["REQUEST_URI"]), '?')) {
                $isPageAllowed = false;
                break;
            }
        }
    }

    if ($userAuthority !== 3) {
        foreach ($superRestrictedAddresses as $address) {
            if ($address === strtok(basename($_SERVER["REQUEST_URI"]), '?')) {
                $isPageAllowed = false;
                break;
            }
        }
    }
}

if (!$isPageAllowed && !isset($userId)) {
    header('Location: ./login.php');
}

if (!$isPageAllowed) {
    echo 'YOU ARE NOT AN AUTHORITY FOR ME!!!';
    die();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Shop Homepage - Start Bootstrap Template</title>

  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <!-- Custom styles for this template -->
  <link href="css/shop-homepage.css" rel="stylesheet">

</head>

<body>
