<?php
/*Připojení do databáze a implementace tříd*/
// připojím se na do databáze (tento soubor vypadá na webu jinak)
$con = mysqli_connect("localhost", "root", "", "prazdninovac") or die("Nelze se připojit");
mysqli_set_charset($con, 'utf8');

// nahraju všechny třídy
function __autoload($class)
{
    include "classes/$class.php";
}