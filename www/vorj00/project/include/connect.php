<?php
/*Připojení do databáze a implementace tříd*/
// připojím se na do databáze (tento soubor vypadá na webu jinak)
require_once "../credentials.php";

$con = mysqli_connect($DBhost, $DBusername, $DBpassword, $DBname) or die("Nelze se připojit");
mysqli_set_charset($con, 'utf8');

// nahraju všechny třídy
spl_autoload_register(function ($class) {
    require_once __DIR__ . "/classes/$class.php";
});