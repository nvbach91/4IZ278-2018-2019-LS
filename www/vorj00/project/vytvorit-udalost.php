<?php
include "include/head.php";

$vytvorit = @$_POST['vytvorit'];
if (!isset($vytvorit)) {
    include "index.php";
} else {
    $event_vytvorit = new Event();
    $event_vytvorit->event_create();
}
