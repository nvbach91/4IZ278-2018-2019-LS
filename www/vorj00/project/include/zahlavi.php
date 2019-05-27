<link rel="stylesheet" href="style/loggedinheader.css">

<div class="headercont">
<div class="header">
	<div class="nadpis"><h1><a href="index">Prázdninovač</a></h1></div>
	<div class="headerright">
	<ul>
		<li>
		<form id="hledani" action="search.php">
			<input type="hidden" name="token" value="<?php echo $token; ?>" />
			<input type="search" name="search" placeholder="Zadej dotaz"><input type="submit" value="Hledat">
		</form>
		</li>
        <div><li><a href="user?id=<?php echo $user_id->id; ?>"><?php echo $user_id->first_name . ' ' . $user_id->last_name; ?></a></li>
            <li><a href="user?id=<?php echo $user_id->id; ?>"><img src="<?php echo $user_id->profile_pic; ?>" height="40px"></a></li></div>

        <li><a href="settings"><i class="fa fa-cog"></i></a></li>
		<li><a href="logout"><i class="fa fa-power-off"></i></a></li>
	</ul>
	</div>
	</div>
</div>