<html>
<?php 
$title = "Seznam událostí";
include "include/head.php";
?>
<link rel="stylesheet" href="style/akceview.css">
<body>
<?php 
include("include/zahlavi.php");
include("include/menu.php"); ?>

<div class="seznamakci">

<?php
    $event = new Event();
    $event->events_list();
?>
    
</div>
</body>
</html>