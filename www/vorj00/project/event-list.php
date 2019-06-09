<html>
<?php
$title = "Seznam událostí";
?>

<head>
    <?php include "include/head.php";?>
    <link rel="stylesheet" href="assets/css/akceview.css">
</head>

<body>
    <?php
include "include/zahlavi.php";
include "include/menu.php";?>

    <div class="seznamakci">

        <?php
$event = new Event();
$event->events_list();
?>

    </div>
</body>

</html>