<?php
// třída na vyhledávání
class Search
{
    // požadavek hledání
    public $search_query;

    // hledání v uživatelích
    public function search_user()
    {
        global $con;
        // vyberu uživatele, kteří mají ve jméně nebo příjmení vyhledávací výraz
        $query = "SELECT * FROM users WHERE (first_name like '%$this->search_query%') or (last_name like '%$this->search_query%')";
        $result = $con->query($query);
        // výsledků může být více, volám while()
        while ($row = $result->fetch_assoc()) {
            // vezmu údaje o uživateli
            $search_user = new User();
            $search_user->id = $row['id'];
            $search_user->user_data();
            // dále vytvářím HTML
            ?>
<div><a href="user.php?id=<?php
echo $search_user->id; ?>">
        <div><img src="<?php
echo $search_user->profile_pic; ?>"></div>
        <div><?php
echo $search_user->first_name . ' ' . $search_user->last_name; ?></div>
    </a></div>
<?php
}
    }
    // hledání v událostech
    public function search_event()
    {
        global $con, $user_id;
        // vyberu událost, která obsahuje ve jméně nebo popisu výraz
        $query = "SELECT * FROM events WHERE ((event_name like '%$this->search_query%') or (event_desc like '%$this->search_query%'))";
        $result = $con->query($query);
        // událostí může být více, volám while
        while ($row = $result->fetch_assoc()) {
            // vezmu údaje události
            $search_event = new Event();
            $search_event->id = $row['event_id'];
            $search_event->event_data();
            // a udělám pole z adminů
            $search_event_admin_explode = explode(",", $search_event->admin);
            // zavolám i účasti
            $search_event->participation();
            // když jsem admin nebo účastník, zobraz
            if (in_array($user_id->id, $search_event_admin_explode) || in_array($user_id->id, $search_event::$vsichni_invited)) {
                // dále HTML na zobrazení
                ?>
<div><a href="<?php
echo $search_event->id; ?>">
        <div><img src="user_data/events_pics/<?php
echo $search_event->photo; ?>"></div>
        <div><?php
echo $search_event->name; ?></div>
    </a></div>
<?php
}
        }
    }
}
?>