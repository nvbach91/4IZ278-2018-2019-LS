<?php
include "classes/login.php";
?>

<div class="headercont">
<div class="header">
	<div class="nadpis"><h1><a href="index">Prázdninovač</a></h1></div>
	<div class="headerright">
	<form id="zahlaviLogin" method="post">
	<input type="hidden" name="token" value="<?php echo $token; ?>" />
	<ul>
		<li><div class="ikona"><i class="fa fa-user"></i></div><input type="email" class="inputvlevo" placeholder="E-mail" name="loginEmail" required></li>
		<li><div class="ikona"><i class="fa fa-lock"></i></div><input type="password" class="inputvlevo" placeholder="Heslo" name="loginHeslo" required></li>
		<li><button type="submit" name="loginSubmit"><i class="fa fa-arrow-circle-right"></i></button></li>
	</ul>
	</form>
	</div>
	</div>
</div>
