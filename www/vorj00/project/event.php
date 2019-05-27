<html>
<?php
require_once "./include/connect.php";
$id_event = $_GET['id'];
$event_detail = new Event();
$event_detail->id = $id_event;
$event_detail->event_data();

$title = $event_detail->name;
?>

<head>
    <?php include "include/head.php";?>
    <link rel="stylesheet" href="assets/css/event.css">
</head>

<body>
    <?php
include "include/zahlavi.php";?>
    <?php include "include/menu.php";

if (isset($_POST['akceUcastniSe'])) {$event_detail->event_participation_click('attending', 'not_going');}
if (isset($_POST['akcenot_going'])) {$event_detail->event_participation_click('not_going', 'attending');}

if (isset($_POST['akceUcastniSeSMAZAT'])) {$event_detail->event_participation_delete('attending');}
if (isset($_POST['akcenot_goingSMAZAT'])) {$event_detail->event_participation_delete('not_going');}

if (isset($_POST['insertpost'])) {
    Post::post_insert();
}
?>
    <div class="akce"
        style="
background: linear-gradient(rgba(44, 62, 80, .8), rgba(44, 62, 80, .8)), url(../user_data/events_pics/<?php echo $event_detail->photo; ?>);">

        <div class="cont">
            <h1><?php echo $event_detail->name; ?></h1>

            <form class="akcepridatform" method="post">
                <input type="hidden" name="token" value="<?php echo $token; ?>" />
                <div class="akcepridat">

                    <?php
$event_detail->participation();

if (in_array($user_id->id, $event_detail->attending_explode)) {
    echo '<button class="active" name="akceUcastniSeSMAZAT">Přidat se</button><button name="akcenot_going">Neúčastnit se</button>';
}

if (in_array($user_id->id, $event_detail->not_going_explode)) {
    echo '<button name="akceUcastniSe">Přidat se</button><button class="active" name="akcenot_goingSMAZAT">Neúčastnit se</button>';
}

if (in_array($user_id->id, $event_detail->invited_explode)) {
    echo '<button name="akceUcastniSe">Přidat se</button><button name="akcenot_going">Neúčastnit se</button>';
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
                    <iframe width="100%" height="300" frameborder="0" class="map" src="https://www.google.com/maps/embed/v1/place?key=AIzaSyCzeO4CjXYLjtcTcXPG4E6QsrehcijWWEw
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
echo $event_detail->show_attendence($event_detail->attending_explode, "fa fa-check-circle");
echo $event_detail->show_attendence($event_detail->not_going_explode, "fa fa-calendar-times-o");
echo $event_detail->show_attendence($event_detail->invited_explode, "fa fa-question-circle");
?>

                    </ul>
                </div>
                <div class="akcepopis"><?php echo $event_detail->desc; ?></div>
            </div>
        </div>
    </div>
</body>

</html>