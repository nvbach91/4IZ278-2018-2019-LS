<?php

require 'db.php';

require 'user_required.php';


require __DIR__ . '/incl/header.php';

 function printHtml ($string) { ?>
     <?php echo $string; ?>
<?php } ?>
<?php
function printTime($city, $timeZone, $dateFormat){
     printHtml("<div>" . $city );
    date_default_timezone_set($timeZone);
    $date = date($dateFormat, time());
    printHtml($date . "</div>");
    printHtml("<br>");
}
?>
    <h1>World clock</h1>
    <br>
<?php


printTime("Prague", "Europe/Prague", "d. m. Y H:i:s");
printTime("Chicago", "America/Chicago", "m/d/y H:i:s");
printTime("Detroit", "America/Detroit", "m/d/y H:i:s");
printTime("Sydney", "Australia/Sydney", "F d, Y H:i:s");
printTime("Bangkok", "Asia/Bangkok", "d/m/Y H:i:s");

?>

<div style="margin-bottom: 300px"></div>
<?php require __DIR__ . '/incl/footer.php'; ?>