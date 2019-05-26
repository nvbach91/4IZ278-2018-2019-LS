<html>
<?php
require_once "./include/connect.php";
$id_event = $_GET['id'];
$event_detail = new Event();
$event_detail->id = $id_event;
$event_detail->event_data();

$title = $event_detail->jmeno;
include "include/head.php";
?>

<body>
    <?php
include "include/zahlavi.php";?>
    <?php include "include/menu.php";

if (isset($_POST['akceUcastniSe'])) {$event_detail->event_participation_click('ucastni_se', 'nemuze');}
if (isset($_POST['akceNemuze'])) {$event_detail->event_participation_click('nemuze', 'ucastni_se');}

if (isset($_POST['akceUcastniSeSMAZAT'])) {$event_detail->event_participation_delete('ucastni_se');}
if (isset($_POST['akceNemuzeSMAZAT'])) {$event_detail->event_participation_delete('nemuze');}

if (isset($_POST['insertpost'])) {
    Post::post_insert();
}
?>
    <div class="akce" style="
background: linear-gradient(rgba(44, 62, 80, .8), rgba(44, 62, 80, .8)), url(../user_data/events_pics/<?php echo $event_detail->foto; ?>);
background-size: 100%;
background-position: center center;">

        <div class="cont">
            <h1><?php echo $event_detail->jmeno; ?></h1>

            <form class="akcepridatform" method="post">
                <input type="hidden" name="token" value="<?php echo $token; ?>" />
                <div class="akcepridat">

                    <?php
$event_detail->participation();

if (in_array($user_id->id, $event_detail->ucastni_se_explode)) {
    echo '<button class="active" name="akceUcastniSeSMAZAT">Přidat se</button><button name="akceNemuze">Neúčastnit se</button>';
}

if (in_array($user_id->id, $event_detail->nemuze_explode)) {
    echo '<button name="akceUcastniSe">Přidat se</button><button class="active" name="akceNemuzeSMAZAT">Neúčastnit se</button>';
}

if (in_array($user_id->id, $event_detail->pozvani_explode)) {
    echo '<button name="akceUcastniSe">Přidat se</button><button name="akceNemuze">Neúčastnit se</button>';
}
?>
                </div>
            </form>
            <div class="flexakce1">
                <div class="termin">
                    <div class="akcedatum">
                        <div><?php echo $event_detail->startDay; ?></div>
                        <div><?php echo $event_detail->startMonth; ?></div>
                        <div><?php echo $event_detail->startHour; ?></div>
                    </div>

                    <div class="akcedatum">
                        <div><?php echo $event_detail->endDay; ?></div>
                        <div><?php echo $event_detail->endMonth; ?></div>
                        <div><?php echo $event_detail->endHour; ?></div>
                    </div>
                </div>
                <div class="akcemistocont">
                    <iframe width="100%" height="300" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?key=AIzaSyCzeO4CjXYLjtcTcXPG4E6QsrehcijWWEw
    &q=<?php echo $event_detail->place; ?>">
                    </iframe>
                </div>
            </div>

            <div class="flexakce2">
                <div class="akceprispevekvlozit">
                    <form method="post">
                        <input type="hidden" name="token" value="<?php echo $token; ?>" />
                        <img src="<?php echo $user_id->profile_pic; ?>">
                        <input name="insertpost" placeholder="Vložit příspěvek...">
                    </form>
                </div>

                <?php
$post_view = new Post();
$post_view->post_read();
?>
            </div>
            <div class="flexakce3">
                <div class="akceucast">
                    <ul>
                        <?php
echo $event_detail->zobrazeni_ucasti($event_detail->ucastni_se_explode, "fa fa-check-circle");
echo $event_detail->zobrazeni_ucasti($event_detail->nemuze_explode, "fa fa-calendar-times-o");
echo $event_detail->zobrazeni_ucasti($event_detail->pozvani_explode, "fa fa-question-circle");
?>

                    </ul>
                </div>
                <div class="akcepopis"><?php echo $event_detail->desc; ?></div>
            </div>
        </div>
    </div>
</body>

</html>