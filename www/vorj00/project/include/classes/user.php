<?php
class User

{
    // id uživatele
	public $id;
    // jméno uživatele
	public $first_name;
    // příjmení uživatele
	public $last_name;
    // email uživatele
	public $email;
    // password uživatele
	private $password;
    // přátelé uživatele
	public $friends;
    // profilový obrázek uživatele
	public $profile_pic;

	// získat data - nepoužívám konstruktor (__construct), protože uživatele občas využívám, když nemám jedno konkrétní id
	public function user_data()

	{
		global $con;
		// MySQL příkaz na uživatele
		$query = "select * from users where id='$this->id'";
		$result = $con->query($query);
		$row = $result->fetch_assoc();
		// beru získané údaje z databáze
		$this->first_name = $row['first_name'];
		$this->last_name = $row['last_name'];
		$this->email = $row['email'];
		$this->password = $row['password'];
		$this->friends = $row['friends'];
		$this->profile_pic = $row['profile_pic'];
	}
	// zobrazení účastí všech uživatelů
	public function user_participation($param, $ikonka)

	{
		global $con;
		// vyberu skupinu uživatelů
		$query = "select * from users where " . $param;
		$result = $con->query($query);
		// skupina může mít více lidí, volám while()
		while ($row = $result->fetch_assoc()) {
			// ukládám získané údaje
			$this->first_name = $row['first_name'];
			$this->last_name = $row['last_name'];
			$this->profile_pic = $row['profile_pic'];
			$this->email = $row['email'];
			$this->password = $row['password'];
			$this->friends = $row['friends'];
			$this->profile_pic = $row['profile_pic'];
			// dále HTML, které ukazuje účast !pozor - často (graficky) upraveno, aby zobrazoval jen 1-5 uživatelů
?>
<li><img src="<?php
			echo $this->profile_pic; ?>">
    <div class="akcestatus"><i class="<?php
			echo $ikonka; ?>"></i></div>
    <div class="akceucastinfo">
        <div><?php
			echo $this->first_name . ' ' . $this->last_name ?></div>
    </div>
</li>
<?php
		}
	}
	// funkce uživatelského profilu o přátelství
	public function user_profile()

	{
		global $con, $user_id, $profile_user;
		// MySQL žádost na žádosti o přátelství, kde přihlášený uživatel žádá zobrazeného uživatele (a naopak)
		$query = "SELECT * FROM friend_requests WHERE (user_from=$user_id->id OR user_from=$this->id) AND (user_to=$user_id->id OR user_to=$this->id)";
		$result = $con->query($query);
		$row = $result->fetch_assoc();
		// proměnná na zprávu, kterí se zobrazí
		$friendshipMsg = '';
		// určení, kdo koho požádal
		$requestFrom = $row['user_from'];
		$requestTo = $row['user_to'];
		/*začátek formulářových akcí*/
		// když chci odstranit mou žádost o přátelství
		if (isset($_POST['removefriendrequest'])) {
			// příkaz na odstranění žádosti a refresh
			$get_friend_request = $con->query("delete from friend_requests where user_from='$requestFrom' and user_to='$requestTo'");
			header("Refresh:0");
		}
		// když chci akceptovat žádost o přátelství
		if (isset($_POST['acceptfriend' . $profile_user->id])) {
			// vytvořím pole přátel přihlášeného uživatele a spočítám je
			$friend_array = $user_id->friends;
			$friendArray_explode = explode(",", $user_id->friends);
			$friendArray_count = count(array_filter($friendArray_explode));
			// to stejné u profilu uživatele
			$friend_array_friend = $profile_user->friends;
			$friendArray_explode_friend = explode(",", $friend_array_friend);
			$friendArray_count_friend = count(array_filter($friendArray_explode_friend));
			// když zatím nemám kamarády, tak vložím jenom jeho, jinak před něj hodím čárku
			if ($friendArray_count == 0) {
				$profile_id_insert = $profile_user->id;
			}
			else {
				$profile_id_insert = ',' . $profile_user->id;
			}
			// stejně provedu i u něj se mnou
			if ($friendArray_count_friend == 0) {
				$user_id_insert = $user_id->id;
			}
			else {
				$user_id_insert = ',' . $user_id->id;
			}
			// přidám ho k sobě do přátel a mě k němu
			$add_friend_query = $con->query("update users set friends=concat('$friend_array','$profile_id_insert') where id='$user_id->id'");
			$add_friend_friend_query = $con->query("update users set friends=concat('$friend_array_friend','$user_id_insert') where id='$profile_user->id'");
			// a odstraním žádost o přátelství
			$delete_request = $con->query("delete from friend_requests where user_from='$requestFrom' and user_to='$requestTo'");
			header("Refresh:0");
		}
		// když chci odmítnout žádost o přátelství
		if (isset($_POST['declinefriend' . $profile_user->id])) {
			// prostě smažu žádost a refreshnu
			$delete_request = $con->query("delete from friend_requests where user_from='$requestFrom' and user_to='$requestTo'");
			header("Refresh:0");
		}
		// když si chci přidat jako přítele
		if (isset($_POST['addfriend'])) {
			// vezmu údaj z formuláře
			$friend_request = $_POST['addfriend'];
			// a vytvořím žádost MySQL dotazem
			$create_request = $con->query("INSERT INTO friend_requests VALUES ('','$user_id->id','$profile_user->id')");
			header("Refresh:0");
		}
		// když si chci odebrat přátele
		if (isset($_POST['removefriend'])) {
			// udělám si pole mých přátel
			$friend_array = $user_id->friends;
			$friend_array_explode = explode(",", $friend_array);
			// udělám pole jeho přátel
			$friend_array_username = $profile_user->friends;
			$friend_array_explode_username = explode(",", $friend_array_username);
			// vytvořím si pomocné proměnné, které odstraním
			$userComma = "," . $user_id->id;
			$userComma2 = $user_id->id . ",";
			$usernameComma = "," . $profile_user->id;
			$usernameComma2 = $profile_user->id . ",";
			// když se bude vyskytovat čárka před id, tak smažu jak id, tak čárku
			if (strstr($friend_array, $usernameComma)) {
				$friend1 = str_replace($usernameComma, "", $friend_array);
			} //když bude čárka jen za jménem, smažu čárku za jménem
			else if (strstr($friend_array, $usernameComma2)) {
				$friend1 = str_replace($usernameComma2, "", $friend_array);
			} //když žádná čárka nebude, smažu jen id
			else if (strstr($friend_array, $profile_user->id)) {
				$friend1 = str_replace($profile_user->id, "", $friend_array);
			}
			// úplně to stejné provedu u bývalého přítele
			if (strstr($friend_array_username, $userComma)) {
				$friend2 = str_replace($userComma, "", $friend_array_username);
			}
			else if (strstr($friend_array_username, $userComma2)) {
				$friend2 = str_replace($userComma2, "", $friend_array_username);
			}
			else if (strstr($friend_array_username, $user_id->id)) {
				$friend2 = str_replace($user_id->id, "", $friend_array_username);
			}
			// odstraním ho z mých přátel a sebe z jeho přátel a pak refreshnu stránku
			$removeFriendQuery = $con->query("update users set friends='$friend1' where id='$user_id->id'");
			$removeFriendQuery_username = $con->query("update users set friends='$friend2' where id='$profile_user->id'");
			header("Refresh:0");
		}
		/*konec formulářových akcí*/
		// když se koukám na svůj profil, zobrazím si místo toho možnost upravení profilu AKA nastavení
		if ($this->id == $user_id->id) {
			echo '<a href="settings"><button>Upravit profil</button><a/>';
		}
		// když se nekoukám na svůj profil
		else { ?>
<form action="user.php?id=<?php
			echo $this->id; ?>" method="post">
    <input type="hidden" name="token" value="<?php echo $token; ?>" />
    <?php
			// udělám si pole mých přátel
			$friendArray = explode(',', $user_id->friends);
			// když tam nějaká žádost je
			if (!$row == "") {
				// když je ta žádost ode mě
				if ($requestFrom == $user_id->id) {
					echo '<button class="background-blue" name="removefriendrequest">Žádost odeslána ×</button>';
				} //když je od něj/ní
				else {
					echo '<h3>Žádost o přátelství:</h3>
        <button type="submit" name="acceptfriend' . $this->id . '">Přijmout</button>
        <button type="submit" name="declinefriend' . $this->id . '" class="background-red">Odmítnout</button>';
				}
			} //když tam žádost není
			else {
				// když je v přátelích
				if (in_array($this->id, $friendArray)) {
					$friendshipMsg = '<button type="submit" name="removefriend">Odebrat z přátel</button>';
				} //když není v přátelích
				else {
					$friendshipMsg = '<button type="submit" name="addfriend">Přidat do přátel</button>';
				}
				// vyjede to, jaká je situace s přátelstvím
				echo $friendshipMsg;
			}
?>
</form>
<?php
		}
	}
	// změna jména
	public function user_update_name()

	{
		global $con;
		// uložím data z formuláře
		$firstname = strip_tags(@$_POST['first_name']);
		$lastname = strip_tags(@$_POST['last_name']);
		// když je krátké jméno
		if (strlen($firstname) < 3) {
			echo '<p class="badAlert">Křestní jméno musí mít alespoň 3 znaky</p>';
		} //když není
		else {
			// když je krátké příjmení
			if (strlen($lastname) < 3) {
				echo '<p class="badAlert">Příjmení musí mít alespoň 3 znaky</p>';
			}
			// když je vše OK
			else {
				// změním jméno, příjmení a refreshuji
				$info_submit_query = $con->query("update users set first_name='$firstname', last_name='$lastname' where id='$this->id'");
				header("Refresh:0");
			}
		}
	}
	// změna e-mailu
	public function user_update_email()

	{
		global $con;
		// uložím údaje z formuláře
		$email = strip_tags(@$_POST['email']);
		// zjistím, zda daný e-mail už není obsazen
		$get_email_query = $con->query("select email from users where email='$email'");
		$get_email_row = $get_email_query->fetch_assoc();
		$get_email = $get_email_row['email'];
		// a když je obsazen
		if ($get_email && ($this->email != $email)) {
			echo '<p class="badAlert">Zadaný e-mail už je přidružen jinde.</p>';
		}
		else if (!$get_email) {
			// pokud není obsazen, změním e-mail a refreshuji
			$email_query = $con->query("update users set email='$email' where id='$this->id'");
			header("Refresh:0");
		}
	}
	// změna profilového obrázku
	public function user_update_profilepic()

	{
		global $con;
		// když má obrázek správný typ a velikost
		if (((@$_FILES['profilepic']['type'] == "image/jpeg") || (@$_FILES['profilepic']['type'] == "image/png") || (@$_FILES['profilepic']['type'] == "image/gif")) && (@$_FILES['profilepic']['size'] < 1048576)) {
			// když je dobrá, uložím si cestu a úplnou cestu
			$path = $_FILES['profilepic']['name'];
			$ext = pathinfo($path, PATHINFO_EXTENSION);
			// fotky přejmenuju, aby se náhodou nepřepsaly - z $chars udělám dvě náhodné 15 místní stringy pro názvy složky a souboru
			$chars = 'abcdecfghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
			$rand_dir_name = substr(str_shuffle($chars) , 0, 15);
			$file_name = substr(str_shuffle($chars) , 0, 15);
			// vezmu koncovku (typ) souboru
			$extension = end(explode(".", $_FILES['profilepic']['name']));
			// budu koukat do složky, zda náhodou neexistuje stejné jméno složky a souboru dokud nenajdu volno v obou případech, budu měnit názvy
			while (file_exists("user_data/profile-pic/$rand_dir_name/" . $file_name)) {
				$rand_dir_name = substr(str_shuffle($chars) , 0, 15);
				$file_name = substr(str_shuffle($chars) , 0, 15) . "." . $extension;
			}
			// pokud daná složka ještě neexistuje, vytvořím ji (může existovat složka, ale název souboru bude jiný)
			if (!(file_exists("user_data/profile-pic/$rand_dir_name"))) {
				mkdir("user_data/profile-pic/$rand_dir_name");
				// přesunu fotku do dané cesty
				move_uploaded_file(@$_FILES['profilepic']['tmp_name'], "user_data/profile-pic/$rand_dir_name/$file_name.$ext");
				// vložím cestu na fotku do databáze
				$profile_pic_query = $con->query("update users set profile_pic='user_data/profile-pic/$rand_dir_name/$file_name.$ext' where id='$this->id'");
				header("Refresh:0");
			}
		}
		else {
			// když formát nebo typ nesedí, hodím chybu a umřu
			echo '<p class="goodAlert">Vloudička se chybila..neplatný soubor (moc velký nebo prostě jen špatný typ)</p>';
		}
	}
	// změna hesla
	public function user_update_password()

	{
		global $con;
		// uložím údaje z formuláře
		$old_password = strip_tags(@$_POST['oldpassword']);
		$new_password = strip_tags(@$_POST['password1']);
		$new_password2 = strip_tags(@$_POST['password2']);
		// když staré password nesedí
		if (!password_verify($old_password, $this->password)) {
			echo '<p class="badAlert">Staré heslo nesedí</p>';
		}
		else {
			// když staré password sedí, ale nová hesla nejsou shodná
			if ($new_password != $new_password2) {
				echo '<p class="badAlert">Tvoje nová hesla nesedí</p>';
			}
			else {
				// když je vše v pořádku, zahashuju nové heslo a uložím do databáze
				$new_password = password_hash($new_password, PASSWORD_DEFAULT);
				$password_update_query = $con->query("update users set password='$new_password' where id='$this->id'");
				echo '<p class="goodAlert">Úspěch</p>';
			}
		}
	}
	// odstranění účtu
	public function user_delete()

	{
		global $con, $user_id;
		// odstraním účet, vyrozumím uživatele a umřu
		$close_account = $con->query("delete from users where id='$user_id->id'");
		echo "Účet odstraněn.";
		session_destroy();
		die();
	}
}
?>