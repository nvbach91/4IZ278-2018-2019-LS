<?php
require 'db.php';
require 'manager_require.php';

$id = $_GET['id'];

require 'check_lock.php';

$goodsDB->delete('id', $id);

header('Location: index.php?delete');
die();

?>