<?php
/*přihlašovací/registrační stránka*/
//na náhodný obrázek
$bg = range(1, 5); // array of filenames
$i = rand(0, count($bg) - 1); // generate random number size of the array
$selectedBg = "$bg[$i]"; // set variable equal to which random filename was chosen
$selectedBg .= ".jpg";
?>
<style type="text/css">
.centerdiv{
background: url("assets/img/homepage-background/<?php echo $selectedBg; ?>");
}
</style>
<html>
<?php
$title = "Přihlášení";
include "include/head.php";
?>
<link rel="stylesheet" href="style/login.css">
<script type="text/javascript" src="js/registrace.js"></script>
<body>
<?php
include "include/fb-login-helper.php";
include "include/zahlavilogin.php";

$login = @$_POST['loginSubmit'];
$registrace = @$_POST['registrovat'];

if (!empty($_POST['token'])) {

    if (hash_equals($_SESSION['token'], $_POST['token'])) {

        if (isset($login)) {
            $check_login = new Login();
            $check_login->login_connect();
        }

        if (isset($registrace)) {
            $registrace_login = new Login();
            $registrace_login->login_registration();
        }
    } else {
        echo "Neplatný token, odešlete prosím formulář znovu.\n";
    }
}
?>

<div class="document centerdiv">
 <form name="registrace" method="post">
 <input type="hidden" name="token" value="<?php echo $token; ?>" />
 <table>
	<tr><td colspan="2"><h2>Registrace</h2></tr>
	<tr><td><input type="text" name="first_name" id="jmeno" placeholder="Jméno"  required></td><td><input type="text" name="prijmeni" id="prijmeni" placeholder="Příjmení" required></td></tr>
	<tr><td colspan="2"><input type="email" name="email" placeholder="E-mail" id="email" required></td></tr>
	<tr><td colspan="2"><input type="email" name="email2" placeholder="E-mail znova" id="confirm_email" onpaste="return false" required></td></tr>
	<tr><td colspan="2"><input type="password" name="heslo" placeholder="Heslo" id="heslo" required></td></tr>
	<tr><td colspan="2"><input type="submit" name="registrovat" id="registrovat" value="Registrovat"></td></tr>
	<tr><td colspan="2"><a href="<?php echo $FBloginUrl ?>">Nah, I want FB</a></td></tr>
  </table>
  </form>
</div>
</body>
</html>