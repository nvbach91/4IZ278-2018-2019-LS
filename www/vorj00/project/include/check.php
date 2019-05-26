<?php
/*Zkontroluje, zda je e-mail v databázi a když ano, hodí chybu*/
// zavolám si connect.php do databáze
require_once ("connect.php");

// když je e-mail nastaven, uložím do proměnné, jinak bude proměnná prázdná
$emailCheck = isset($_POST['email']) ? $_POST['email'] : "";
// když tedy existuje proměnná
if ($emailCheck != null) {
	global $con;
	// kouknu, zda existuje stejný e-mail a spočítám řady
	$pocetmailuCheck_query = $con->query("SELECT email FROM users where email='$emailCheck'");
	$pocetmailuCheck = $pocetmailuCheck_query->num_rows;
	// když tam nějaký bude, spustím JSON, který pošle zprávu, že je e-mail zabrán
	if ($pocetmailuCheck > 0) {
		echo json_encode("emailzabran");
	}
}