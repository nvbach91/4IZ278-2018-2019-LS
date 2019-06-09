<?php
/*úvodní stránka - pouze přesměruje, když není/je uživatel přihlášen*/
session_start();

if(!isset($_SESSION['user_id'])){
	include("login.php");
} else {
?>
<?php include("event-list.php"); ?>
<?php } ?>