<?php
// třída na hledání top termínu
class Termin

{
    // možný počátek akce (od uživatele)
	public $start_input;
    // počátek akce zaokrouhlen na celou hodinu
	public $start_interval;
    // pomocný počátek akce zaokrouhlen na celou hodinu
	public $start_pomoc;
    // možný konec akce (od uživatele)
	public $end_input;
    // konec akce zaokrouhlen na celou hodinu
	public $end_interval;
    // pozvaní lidé (od uživatele)
	public $invite;
    // počet hodin mezi počátečním a konečným datem
	public $interval;
    // počet hodin trvání akce (od uživatele)
	public $trvani;
    // počet sekund trvání akce
	public $trvani_sekund;
    // počet možností datumů ($interval-$trvani+1)
	public $vypocet;
    // akce, kterých se účastní aspoň jeden z pozvaných
	public $ucasti;

	// zpracování vstupních dat
	public function termin_input_data()

	{
		global $con, $find_termin_event;
		// uložím data z formuláře
		$this->start_input = strtotime($_POST['od']);
		$this->end_input = strtotime($_POST['do']);
		$trvani_dni = $_POST['dni'];
        // když nejsou pozvaní, bude prázné pole, jinak data z formuláře
		if(isset($_POST['invite'])){$this->invite = @$_POST['invite'];}else{$this->invite = [];}
		// pozvané spočítám a vytvořím proměnnou, ze které bude součást MySQL příkazu
		$invite_count = count($this->invite);
		$invite_textarray = "";
		// když bude jen jeden uživatel, uložím jen jeho, jinak dám za každého (krom posledního) čárku pro MySQL
		if ($invite_count) {
			foreach($this->invite as $key => $value) {
				$invite_textarray.= $value;
				if (!($key + 1 == $invite_count)) {
					$invite_textarray.= ',';
				}
			}
		}
		// další hodnoty spočítám
		$moznosti = [];
		$this->ucasti = [];
		$this->start_interval = ($this->start_input - ($this->start_input % 3600));
		$this->start_pomoc = $this->start_interval;
		$this->end_interval = ($this->end_input - ($this->end_input % 3600));
		$this->trvani = $trvani_dni * 24;
		$this->interval = ($this->end_interval - $this->start_interval) / 3600;
		$this->trvani_sekund = $this->trvani * 3600;
		$this->vypocet = ($this->interval - $this->trvani + 1);
	}
	// vypíšu vstupní data
	public function termin_input_data_echo()

	{
		global $con, $find_termin_event;
		// vypsání vstupních dat
		echo 'START: ' . date("d.m.Y H:i:s", $this->start_input) . '<br />' . 'START_EDIT: ' . date("d.m.Y H:i:s", $this->start_interval) . '<br />' . 'KONEC: ' . date("d.m.Y H:i:s", $this->end_input) . '<br />' . 'KONEC_EDIT: ' . date("d.m.Y H:i:s", $this->end_interval) . '<br />' . 'INTERVAL HODIN: ' . $this->interval . '<br />' . 'AKCE TRVÁ HODIN: ' . $this->trvani . '<br />' . 'MOŽNOSTÍ (INTERVAL - TRVÁ + 1): ' . $this->vypocet . '<br /><br />';
	}
	// vypsání výstupu algoritmu
	public function termin_output_data_echo()

	{
		global $con;
		// když vyjde existuje aspoň jedna možnost na základě vstupní dat
		if ($this->vypocet > 0) {
			// vytvořím pole všech možností
			for ($i = 0; $i < $this->vypocet; $i++) {
				$moznosti[$i] = $this->start_pomoc;
				$this->start_pomoc+= 3600;
			}
			// vyberu události
			$events_query = $con->query("select * from events");
			// může jich být víc, volám while()
			while ($events_row = $events_query->fetch_assoc()) {
				// vezmu údaje
				$event_spec = new Event();
				$event_spec->id = $events_row['event_id'];
				$event_spec->event_data();
				// správný formát data
				$event_startdate = date("d.m.Y", $event_spec->startdate);
				$event_starttime = date("H:i", $event_spec->starttime);
				$event_enddate = date("d.m.Y", $event_spec->enddate);
				$event_endtime = date("H:i", $event_spec->endtime);
				$start_total = strtotime("$event_startdate $event_starttime");
				$end_total = strtotime("$event_enddate $event_endtime");
				// beru účasti
				$event_spec->participation();
				// když se kdokoli z pozvaných jako účastník akce, přidá se akce do $this->ucasti
				if (!empty(array_intersect($this->invite, $event_spec->attending_explode))) {
					array_push($this->ucasti, array(
						$start_total,
						$end_total
					));
				}
			}
			// projdu polem uživatele
			for ($my_row = 0; $my_row < count(array_filter($this->ucasti)); $my_row++) {
				// projdu polem možností
				foreach($moznosti as $moznosti_key => $moznosti_value) {
					// kouknu, jestli se akce kryje s možností
					if (($moznosti_value < $this->ucasti[$my_row][1]) && (($moznosti_value + $this->trvani_sekund) > $this->ucasti[$my_row][0])) {
						// a když ano, odstraním možnost
						unset($moznosti[$moznosti_key]);
					}
				}
			}
			// když vyjde alespoň jedna možnost po vykonání algoritmu
			if (count(array_filter($moznosti))) {
				// volám, vypisuji
				foreach($moznosti as $vals) {
					echo '<div>' . date("d.m.Y H:i", $vals) . ' - ' . date("d.m.Y H:i", ($vals + $this->trvani_sekund)) . '</div>';
				}
			}
			// když na výstupu nic nevyjde
			else { ?>
<h2>V daném rozpětí bohužel není volný termín</h2>
<?php
			}
		}
		// když vstupní podmínky neumožňují výstup
		else { ?>
<h2>Za daných podmínek nelze najít vhodné datum</h2>
<?php
		}
	}
}
?>