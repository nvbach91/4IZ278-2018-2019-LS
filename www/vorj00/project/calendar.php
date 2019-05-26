<html>
<?php 
$title = "Kalendář";
include "include/head.php";
?>
<body>
<?php
include "include/zahlavi.php";?>
<?php include "include/menu.php";?>
<div class="cont">
	<link rel="stylesheet" href="assets/css/monthly.css">
		<div style="text-align:center; margin: auto; width:50vw">
			<div class="monthly" id="mycalendar"></div>
		</div>

<script type="text/javascript" src="js/jquery-2.2.0.js"></script>
<script type="text/javascript" src="js/monthly.js"></script>
<script type="text/javascript">
	$(window).load( function() {

		$('#mycalendar').monthly({
			mode: 'event',
			xmlUrl: 'calendar-event-export.php'
		});


	});
</script>
</div>
</body>
</html>