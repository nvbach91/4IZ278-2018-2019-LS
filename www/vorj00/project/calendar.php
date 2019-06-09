<html>
<?php
$title = "Kalendář";
?>

<head>
    <?php include "include/head.php";?>
    <link rel="stylesheet" href="assets/css/calendar.css">
</head>

<body>
    <?php
include "include/zahlavi.php";?>
    <?php include "include/menu.php";?>
    <div class="cont">
        <link rel="stylesheet" href="assets/css/monthly.css">
        <div class="calendar">
            <div class="monthly" id="mycalendar"></div>
        </div>
    </div>
    <!-- třeba staré jQUERY -->
    <script type="text/javascript" src="assets/js/jquery-2.2.0.js"></script>
    <script type="text/javascript" src="assets/js/monthly.js"></script>
    <script type="text/javascript">
    $(window).load(function() {

        $('#mycalendar').monthly({
            mode: 'event',
            xmlUrl: 'calendar-event-export.php'
        });


    });
    </script>
</body>

</html>