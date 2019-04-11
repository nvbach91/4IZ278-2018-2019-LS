<?php
require_once 'ProductsDB.php';

$DB = new ProductsDB();
$DB->insertTableCategory();
$DB->insertTableProduct();
$DB->insertTableSlider();