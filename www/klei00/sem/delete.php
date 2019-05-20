<?php
require 'db.php';
require 'manager_require.php';

$id = $_GET['book'];

require 'check_lock.php';

$booksDB->delete('book_code', $id);

header('Location: index.php?delete');
die();

?>