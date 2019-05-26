<?php

require_once "event.php";
require_once "comment.php";

// třída na příspěvky dědí událost
class Post extends Event
{
    // statické id příspěvku
    public static $static_post_id;
    // id příspěvku
    public $post_id;
    // id autora příspěvku
    public $post_user_from;
    // datum vložení příspěvku
    public $post_date_posted;
    // tělo příspěvku
    public $post_body;

    // pro zobrazení příspěvků
    public function post_read()
    {
        global $con, $user_id;
        // z rodiče (události) si zjistím id
        $insert_event_id = parent::$static_event_id;
        // zavolán tabulku příspěvků se stejným id jako má událost
        $query = "select * from events_posts where id_event='$insert_event_id' order by id desc";
        $result = $con->query($query);
        // příspěvků může být víc, volám while()
        while ($row = $result->fetch_assoc()) {
            // z postu si vezmu údaje
            $this->post_id = $row['id'];
            self::$static_post_id = $this->post_id;
            $this->post_user_from = $row['user_from'];
            $this->post_date_posted = strtotime($row['date_posted']);
            $this->post_body = $row['body'];
            // upravím datum přidání do správného formátu
            $this->post_date_posted = iconv('windows-1250', 'utf-8', strftime('%d. %B %Y, %H:%M', $this->post_date_posted));
            // když k příspěvku vkládám komentář - musí to být zde, abych věděl, k jakému postu přiřadit komentář
            if (isset($_POST['insertcomment' . $this->post_id])) {
                // vezmu údaje a vložím je do údajů komentáře $insert_comment
                $insert_comment = new Comment();

                $insert_comment->comment_user_from = $user_id->id;
                $insert_comment->comment_date = date("Y-m-d H:i:s");
                $insert_comment->comment_body = $_POST['insertcomment' . $this->post_id];
                // vložím údaje do databáze
                $insert_comment_query = $con->query("insert into events_comments values ('','$this->post_id','$user_id->id','$insert_comment->comment_date','$insert_comment->comment_body','')");
            }
            // vezmu data osoby, která vytvořila post
            $user_poster = new User();
            $user_poster->id = $this->post_user_from;
            $user_poster->user_data();
            // dále zobrazím HTML z daných údajů
            ?>

<div class="akceprispevekcont">
    <div class="akceprispevek">
        <div class="akceprispevekleft"><img src="<?php
echo $user_poster->profile_pic ?>"></div>
        <div class="akceprispevekright">
            <div class="akceprispevekheader">
                <h2><?php
echo $user_poster->first_name . ' ' . $user_poster->prijmeni; ?></h2><?php
echo $this->post_date_posted; ?>
            </div>
            <div class="akceprispevekprispevek">
                <p><?php
echo $this->post_body; ?></p>
            </div>
        </div>
    </div>

    <?php
// pokud jsou komenty k postu, zobrazím je
            $comment_view = new Comment();

            $comment_view->comment_read();
            // dále zobrazím možnost přihlášeného uživatele také komentovat post
            ?>
    <div class="akceprispevekokomentovat"><img src="<?php
echo $user_id->profile_pic; ?>">
        <form method="post">
            <input type="hidden" name="token" value="<?php echo $token; ?>" />
            <input name="insertcomment<?php
echo $this->post_id ?>" placeholder="Napsat komentář..."></form>
    </div>
</div>
<?php
}
    }
    // vložení příspěvku
    public function post_insert()
    {
        global $con, $user_id;
        // vezmu příspěvek z formuláře, id události, aktuální datum
        $insert_post_body = $_POST['insertpost'];
        $insert_event_id = parent::$static_event_id;
        $insert_post_date = date("Y-m-d H:i:s");
        // vložím do databáze a refreshuji stránku
        $insert_post_body_query = $con->query("insert into events_posts values ('','$insert_event_id','$user_id->id','$insert_post_date','$insert_post_body','')");
        header("Refresh:0");
    }
}

?>