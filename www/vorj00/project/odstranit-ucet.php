<?php
/*odstranění účtu*/
$title = "Odstranění účtu";
require_once("include/head.php");
if($user_id->id){
if(isset($_POST['no'])){
	header("location: settings.php");
}
if(isset($_POST['yes'])){
    $user_id->user_delete();   
}
}
else{
	die("Musíš být přihlášen, ty anonyme.");
}
?>
<center>
<form action="odstranit-ucet.php" method="post">
<input type="hidden" name="token" value="<?php echo $token; ?>" />
Opravdu chceš uzavřít svůj účet?<br>
<input type="submit" name="yes" value="Ano">
<input type="submit" name="no" value="Ne, chci zpátky!">
</form>
</center>