<?php
// třída na události
class Event

{
	// $static_event_id a $event_id budou totožné (kromě toho, že jsou statické), ale mám je zde pro větší přehled
	public static $static_event_id;
    // id události
	public $event_id;
    // jméno události
	public $jmeno;
    // foto události
	public $foto;
    // místo události
	public $place;
    // počáteční datum události
	public $startdate;
    // počáteční čas události
	public $starttime;
    // konečné datum události
	public $enddate;
    // konečný čas události
	public $endtime;
    // popis události
	public $desc;
    // admin události
	public $admin;
    // počáteční den události
	public $startDay;
    // počáteční rok události
	public $startYear;
    // počáteční měsíc události
	public $startMonth;
    // počáteční hodina události
	public $startHour;
    // konečný den události
	public $endDay;
    // konečný rok události
	public $endYear;
    // konečný měsíc události
	public $endMonth;
    // konečná hodina události
	public $endHour;
    // pole účastnících se
	public $ucastni_se_explode;
    // pole neúčastnících se
	public $nemuze_explode;
    // pole pozvaných
	public $pozvani_explode;
    // pole všech pozvaných, neúčastnících se a pozvaných
	public static $vsichni_pozvani;

	// získá data z databáze a přiřadí
	public function event_data()

	{
		// budu používat vždy u fcí - vezmu si proměnné $con do databáze u $user_id pro zjištění, o jakého uživatele se jedná
		global $con, $user_id;
		// příkaz MySQL
		$query = "select * from events where event_id='$this->id'";
		// volání příkazu
		$result = $con->query($query);
		// vyfetchuju data, abych je mohl snadněji získat
		$row = $result->fetch_assoc();
		// přiřazení z databáze
		$this->event_id = $row['event_id'];
		self::$static_event_id = $this->event_id;
		$this->jmeno = $row['event_name'];
		$this->foto = $row['event_photo'];
		$this->place = $row['event_place'];
		$this->startdate = strtotime($row['event_startdate']);
		$this->starttime = strtotime($row['event_starttime']);
		$this->enddate = strtotime($row['event_enddate']);
		$this->endtime = strtotime($row['event_endtime']);
		$this->desc = $row['event_desc'];
		$this->admin = $row['event_admin'];
		// získání správného formátu datumu
		$this->event_date_output();
	}
	// získám přehled o účastech všech typů - účast/neúčast/pozvání
	public function participation()

	{
		global $con;
		// MySQL příkaz
		$query = "select * from participation where id='$this->event_id'";
		// volání příkazů
		$result = $con->query($query);
		// fetch příkazu
		$row = $result->fetch_assoc();
		// přirazení z fetchu
		$ucastni_se = $row['ucastni_se'];
		// vytvoření pole
		$this->ucastni_se_explode = explode(",", $ucastni_se);
		$nemuze = $row['nemuze'];
		$this->nemuze_explode = explode(",", $nemuze);
		$pozvani = $row['pozvani'];
		$this->pozvani_explode = explode(",", $pozvani);
		// přiřazení do statické proměnné souhrn všech pozvaných, jedná se o pole
		self::$vsichni_pozvani = array_merge($this->ucastni_se_explode, $this->nemuze_explode, $this->pozvani_explode);
	}
	// reálné zobrazení účastí na obrazovce, $typ je druh účasti (účast/neúčast/pozvání), $ikonka je ikonka, která se zobrazí u uživatele (účast - zelená fajfka, neúčast - červený škrtnutý kalendář, pozvání - modrý otazník)
	public function zobrazeni_ucasti($typ, $ikonka)

	{
		global $con;
		// spočítám počet lidí v daném typu účasti
		$count = count(array_filter($typ));
		// pokud je někdo v typu účasti, zobrazím ho s danou ikonkou
		if ($count) {
			// vytvořím si pomocnou proměnnou, která bude použita pro MySQL příkaz
			$lide = "";
			// pokud bude v typu účasti jen jeden člověk, bude $lide rovna jeho hodnotě, pokud ne, přidá se za každého (kromě posledního) příkaz OR, který používá MySQL
			foreach($typ as $key => $value) {
				$lide.= "id=$value";
				if (!($key + 1 == $count)) {
					$lide.= " or ";
				}
			}
			// vyechuji fci, která napíše správně HTML formát
            /* tohle funguje jen na localhostu, ne na serveru, nevím proč:
			echo user::user_participation($lide, $ikonka); */
            $user_participate = new User();
            echo $user_participate->user_participation($lide, $ikonka);
		}
	}
	// pokud je rok události jiný než je aktuální rok, zobrazím ho
	public function event_year($year)

	{
		if ($year != strftime('%Y')) {
			return ' %Y';
		}
	}
	// zobrazení správného formátu data
	public function event_date_output()

	{
		// nastavím lokalizaci - aktuálně funguje pouze na localhostu, na webu bohužel ne
		setlocale(LC_ALL, 'cs');
		// snažím se zobrazit lokální formát data, jak jsem psal, na webu to bohužel tolik nefunguje (např. zobrazení měsíce v jazyce uživatele)
		$this->startDay = iconv('windows-1250', 'utf-8', strftime('%d', $this->startdate));
		$this->startYear = iconv('windows-1250', 'utf-8', strftime('%Y', $this->startdate));
		$this->startMonth = iconv('windows-1250', 'utf-8', strftime('%B ' . $this->event_year($this->startYear) , $this->startdate));
		$this->startHour = iconv('windows-1250', 'utf-8', strftime('%H:%M', $this->starttime));
		$this->endDay = iconv('windows-1250', 'utf-8', strftime('%d', $this->enddate));
		$this->endYear = iconv('windows-1250', 'utf-8', strftime('%Y', $this->enddate));
		$this->endMonth = iconv('windows-1250', 'utf-8', strftime('%B ' . $this->event_year($this->endYear) , $this->enddate));
		$this->endHour = iconv('windows-1250', 'utf-8', strftime('%H:%M', $this->endtime));
	}
	// zobrazení událostí uživatele
	public function events_list()

	{
		global $con, $user_id;
		// MySQL query
		$query = "select * from events";
		// MySQL příkaz
		$result = $con->query($query);
		// událostí pro uživatele může být více, použiju proto while()
		while ($row = $result->fetch_assoc()) {
			// lokalizace, nefunguje na webu
			setlocale(LC_ALL, '');
			// přiřazení z MySQL
			$this->event_id = $row['event_id'];
			$this->jmeno = $row['event_name'];
			$this->foto = $row['event_photo'];
			$this->place = $row['event_place'];
			$this->startdate = strtotime($row['event_startdate']);
			$this->starttime = strtotime($row['event_starttime']);
			$this->enddate = strtotime($row['event_enddate']);
			$this->endtime = strtotime($row['event_endtime']);
			$this->desc = $row['event_desc'];
			$this->admin = $row['event_admin'];
			// z admin řady si vytvořím pole (MySQL to samotné nezvládne)
			$admin_explode = explode(",", $this->admin);
			// získám přehled o účastech všech typů události - účast/neúčast/pozvání
			$this->participation();
			// pokud je uživatel adminem události nebo je nějakým způsobem v guestlistu, zobrazím mu událost
			if (in_array($user_id->id, $admin_explode) || in_array($user_id->id, self::$vsichni_pozvani)) {
				// nastavím správný formát datumu
				$this->event_date_output();
				// dále pokračuje HTML zobrazení karty události
?>

<div class="akceviewcont" style="background: url(user_data/events_pics/<?php
				echo $this->foto; ?>);
	background-size: cover;
	background-position: center center;">
    <div class="akceview">
        <div class="nadpis">
            <h1><a href="<?php
				echo $this->event_id ?>"><?php
				echo $this->jmeno; ?></a></h1>
        </div>
        <div class="eventlistTermin">
            <div><?php
				echo $this->startDay; ?>. <?php
				echo $this->startMonth; ?> <?php
				echo $this->startHour; ?></div>
            <div>-</div>
            <div><?php
				echo $this->endDay; ?>. <?php
				echo $this->endMonth; ?> <?php
				echo $this->endHour; ?></div>

        </div>
        <div class="akceucast oneline">
            <ul>
                <?php
				// zobrazím účastníků s ikonkou účasti; pozor! CSS je nastaveno, aby zobrazilo jen první řadu (počet lidí v ní: 1-5)
				echo $this->zobrazeni_ucasti($this->ucastni_se_explode, "fa fa-check-circle");
				echo $this->zobrazeni_ucasti($this->nemuze_explode, "fa fa-calendar-times-o");
				echo $this->zobrazeni_ucasti($this->pozvani_explode, "fa fa-question-circle");
?>
            </ul>
        </div>
        <div class="relative">
            <div class="akceviewPopis"><?php
				echo $this->desc; ?></div><span class="akceviewPopisMore"><i class="fa fa-arrow-circle-o-right"
                    aria-hidden="true"></i></span>
        </div>
    </div>
</div>

<?php
			}
		}
	}
	// výběr přátel, když vytvářím novou akci/hledám top termín
	public function event_user_vyber()

	{
		global $con, $user_id;
		// vyberu přátele
		$query = "select pratele from users where id='$user_id->id'";
		$result = $con->query($query);
		$row = $result->fetch_assoc();
		// zpracuji do pole a spočítám
		$friends = $row['pratele'];
		$friends_explode = explode(",", $friends);
		$friends_explode_count = count(array_filter($friends_explode));
		$friends = "";
		// když tam je alespoň jeden přítel, začně legrace
		if ($friends_explode_count) {
			// vytvořím MySQL výběr - za každého z výběru, kromě posledního, se vloží MySQL příkaz OR
			foreach($friends_explode as $key => $value) {
				$friends.= "id=$value";
				if (!($key + 1 == $friends_explode_count)) {
					$friends.= " or ";
				}
			}
			// zavolám všechny kamarády
			$friendsInfo_query = $con->query("select * from users where $friends");
			// může jich být víc, volám tedy while()
			while ($friendsInfo_row = $friendsInfo_query->fetch_assoc()) {
				// vezmu si jejich údaje
				$friend = new User();
				$friend->id = $friendsInfo_row['id'];
				$friend->user_data();
				// a dále je zobrazím v HTML
?>
<tr>
    <td><input type="checkbox" name="invite[]" value="<?php
				echo $friend->id; ?>"></td>
    <td><img src="<?php
				echo $friend->profile_pic; ?>"></td>
    <td><?php
				echo $friend->first_name . ' ' . $friend->prijmeni; ?></td>
</tr>
<?php
			}
		}
	}
	// vytvoření události
	public function event_create()

	{
		global $con, $user_id;
		// vezmu údaje z formuláře
		$nazev = @$_POST['nazev'];
		$foto = @$_FILES['foto']['name'];
		$kde = @$_POST['kde'];
		$od = @$_POST['od'];
		$do = @$_POST['do'];
		$kdo = @$_POST['kdo'];
		$co = @$_POST['co'];
		// k datu musím přidat sekundy pro správný formát
		$odDatum = substr($od, 0, strpos($od, " "));
		$odCas = substr($od, 11) . ":00";
		$doDatum = substr($do, 0, strpos($do, " "));
		$doCas = substr($do, 11) . ":00";
		// zjistím pozvané, uložené v poli, spočítám a vytvořím proměnnou pro budoucí přidání lidí
		$invite = @$_POST['invite'];
		$invite_count = count($invite);
		$invite_textarray = "";
		// vytvořím z pole string vhodný pro MySQL
		if ($invite_count) {
			foreach($invite as $key => $value) {
				$invite_textarray.= $value;
				if (!($key + 1 == $invite_count)) {
					$invite_textarray.= ',';
				}
			}
		}
		// když chybí fotka, dám defaultní
		if (!$foto) {
			$foto = "default.jpg";
		}
		else {
			// když ne, zkontroluji formát a velikost
			if (((@$_FILES['foto']['type'] == "image/jpeg") || (@$_FILES['foto']['type'] == "image/png") || (@$_FILES['foto']['type'] == "image/gif")) && (@$_FILES['foto']['size'] < 5242880)) {
				// když je dobrá, uložím si cestu a úplnou cestu
				$path = $_FILES['foto']['name'];
				$ext = pathinfo($path, PATHINFO_EXTENSION);
				// fotky přejmenuju, aby se náhodou nepřepsaly - z $chars udělám dvě náhodné 15 místní stringy pro názvy složky a souboru
				$chars = 'abcdecfghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
				$rand_dir_name = substr(str_shuffle($chars) , 0, 15);
				$file_name = substr(str_shuffle($chars) , 0, 15);
				// vezmu koncovku (typ) souboru
				$extension = end(explode(".", $_FILES['foto']['name']));
				// budu koukat do složky, zda náhodou neexistuje stejné jméno složky a souboru dokud nenajdu volno v obou případech, budu měnit názvy
				while (file_exists("user_data/events_pics/$rand_dir_name/" . $file_name)) {
					$rand_dir_name = substr(str_shuffle($chars) , 0, 15);
					$file_name = substr(str_shuffle($chars) , 0, 15) . "." . $extension;
				}
				// pokud daná složka ještě neexistuje, vytvořím ji (může existovat složka, ale název souboru bude jiný)
				if (!(file_exists("user_data/events_pics/$rand_dir_name"))) {
					mkdir("user_data/events_pics/$rand_dir_name");
				}
				// uložím si výsledek cesty
				$foto = "$rand_dir_name/$file_name.$ext";
				// přesunu fotku do dané cesty
				move_uploaded_file(@$_FILES['foto']['tmp_name'], "user_data/events_pics/$foto");
			}
			// když formát nesedí, hodím chybu a umřu
			else {
				echo '<p class="goodAlert">Vloudička se chybila..neplatný soubor (moc velký nebo prostě jen špatný typ)</p>';
				die();
			}
		}
		// vložím údaje do databáze
		$event_query_push = $con->query("insert into events values ('','$nazev','$foto','$kde','$odDatum','$odCas','$doDatum','$doCas','$co','$user_id->id')");
		// z databáze si vytáhnu id vytvořené události
		$id = $con->insert_id;
		// do účastí vložím admina jako účastníka a pozvané do pozvaných
		$participation_query_push = $con->query("insert into participation values ($id,'$user_id->id','','$invite_textarray')");
		// a nakonec se přesměruju na vytvořenou akci
		header('Location: /' . $id);
	}
	// když změním typ účasti
	public function event_participation_click($akce_primarni, $akce_kontra)

	{
		global $con, $user_id;
		// vezmu si účasti z databáze, vytvořím pole a spočítám
		$get_akce_check = $con->query("select * from participation where id='$this->event_id'");
		$get_akce_row = $get_akce_check->fetch_assoc();
		$akce_array = $get_akce_row[$akce_primarni];
		$akce_explode = explode(",", $akce_array);
		$akce_array_count = count(array_filter($akce_explode));
		// pokud bude v poli jen jeden uživatel, přidám jen jeho, jinak přidám před něj i čárku (MySQL neumí pole, musím to dělat takto)
		if ($akce_array_count == 0) {
			$user_id_insert = $user_id->id;
		}
		else {
			$user_id_insert = ',' . $user_id->id;
		}
		// když měním typ účasti, z opačného možná odcházím - to si tady zjistím, vytvořím z ní pole a spočítám
		$akce_kontra_array = $get_akce_row[$akce_kontra];
		$akce_kontra_explode = explode(",", $akce_kontra_array);
		// když se budu nacházet v opačném typu účasti, který chci opustit (účast->neúčast a obráceně), zjistím si klíč pole a odeberu ho
		if (($key = array_search($user_id->id, $akce_kontra_explode)) !== false) {
			unset($akce_kontra_explode[$key]);
			$akce_kontra_implode = true;
		}
		else {
			$akce_kontra_implode = false;
		}
		// pokud jsem byl v kontra typu, udělám z pole string (pro MySQL) a upravím typ účasti, ze které odcházím
		if ($akce_kontra_implode) {
			$akce_kontra_implode = implode(",", $akce_kontra_explode);
			$akce_kontra_query = $con->query("update participation set $akce_kontra='$akce_kontra_implode' where id='$this->event_id'");
		}
		// vezmu si pozvané lidi do pole
		$akce_pozvani_array = $get_akce_row['pozvani'];
		$akce_pozvani_explode = explode(",", $akce_pozvani_array);
		// když budu v pozvaných, odeberu se z nich
		if (($key = array_search($user_id->id, $akce_pozvani_explode)) !== false) {
			unset($akce_pozvani_explode[$key]);
			$akce_pozvani_implode = true;
		}
		else {
			$akce_pozvani_implode = false;
		}
		// pokud jsem byl v pozvaných, udělám z pole pozvaných string (pro MySQL) a upravím pozvané
		if ($akce_pozvani_implode) {
			$akce_kontra_implode = implode(",", $akce_pozvani_explode);
			$akce_pozvani_query = $con->query("update participation set pozvani='$akce_kontra_implode' where id='$this->event_id'");
		}
		// nakonec se přidám do kliknutého typu účasti
		$akce_query = $con->query("update participation set $akce_primarni=concat('$akce_array','$user_id_insert') where id='$this->event_id'");
	}
	// když pouze ruším typ účasti
	public function event_participation_delete($akce_kontra)

	{
		global $con, $user_id;
		// vyberu pozvání
		$get_akce_check = $con->query("select * from participation where id='$this->event_id'");
		$get_akce_row = $get_akce_check->fetch_assoc();
		// vyberu typ účasti, ze které odcházím a hodím do pole
		$akce_kontra_array = $get_akce_row[$akce_kontra];
		$akce_kontra_explode = explode(",", $akce_kontra_array);
		// kontrola - když v ní budu, najdu si klíč a pomocí jeho znalosti se odstraním
		if (($key = array_search($user_id->id, $akce_kontra_explode)) !== false) {
			unset($akce_kontra_explode[$key]);
			$akce_kontra_implode = true;
		}
		else {
			$akce_kontra_implode = false;
		}
		// kontrola - když jsem tam opravdu byl, hodím to celé nakonec do stringu (pro MySQL) a updatuju řadu
		if ($akce_kontra_implode) {
			$akce_kontra_implode = implode(",", $akce_kontra_explode);
			$akce_kontra_query = $con->query("update participation set $akce_kontra='$akce_kontra_implode' where id='$this->event_id'");
		}
		// vyberu si pozvané, hodím do pole a spočítám je
		$akce_pozvani_array = $get_akce_row['pozvani'];
		$akce_pozvani_explode = explode(",", $akce_pozvani_array);
		$akce_pozvani_array_count = count(array_filter($akce_pozvani_explode));
		// když tam nikdo nebude, přidám jen sebe, jinak před sebe dám čárku
		if ($akce_pozvani_array_count == 0) {
			$akce_pozvani_insert = $user_id->id;
		}
		else {
			$akce_pozvani_insert = ',' . $user_id->id;
		}
		// nakonec se přidám do pozvaných
		$akce_pozvani_query = $con->query("update participation set pozvani=concat('$akce_pozvani_array','$akce_pozvani_insert') where id='$this->event_id'");
	}
}

?>