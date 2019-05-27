<?php

require_once "Event.php";
require_once "Post.php";

// třída na komentáře dědí příspěvky
class Comment extends Post
{
    // id komentáře
    public $comment_id;
    // autor komentáře
    public $comment_user_from;
    // datum vložení komentáře
    public $comment_date;
    // tělo komentáře
    public $comment_body;

    // zobrazené komentářů
    public function comment_read()
    {
        global $con, $user_id;
        // zachytím id události a zavolám komenty, které patří k postu
        $read_post_id = parent::$static_post_id;
        $query = "select * from events_comments where id_post='$read_post_id'";
        $result = $con->query($query);
        // komentářů může být více, volám while()
        while ($row = $result->fetch_assoc()) {
            // vezmu získané údaje
            $this->comment_id = $row['id'];
            $this->comment_user_from = $row['user_from'];
            $this->comment_date = strtotime($row['date_posted']);
            $this->comment_body = $row['body'];
            // převedu správný formát datumu
            $this->comment_date = iconv('windows-1250', 'utf-8', strftime('%d. %B %Y, %H:%M', $this->comment_date));
            // získám si data uživatele, který vytvořil daný komentář
            $user_commenter = new User();
            $user_commenter->id = $this->comment_user_from;
            $user_commenter->user_data();
            // dále zobrazím komentář
            ?>

<div class="akcekoment">
    <div class="akcekomentleft"><img src="<?php
echo $user_commenter->profile_pic ?>"></div>
    <div class="akcekomentright">
        <div class="akceprispevekheader">
            <h2><?php
echo $user_commenter->first_name . ' ' . $user_commenter->last_name; ?></h2> <?php
echo $this->comment_date; ?>
        </div>
        <div class="akceprispevekkoment">
            <p><?php
echo $this->comment_body; ?></p>
        </div>
    </div>
</div>
<?php
}
    }
}
?>