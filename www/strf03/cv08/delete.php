<?php
require 'db.php';


$id=$_GET['id'];

$stmt = $db->prepare("DELETE FROM goods WHERE id=?");
$stmt->bindValue(1, $id, PDO::PARAM_INT);
$stmt->execute();
header('Location: index.php?state=delete');
