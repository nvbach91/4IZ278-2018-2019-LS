<html>
<?php 
$title = "Výsledky — Najít top termín";
include "include/head.php";
?>
<link rel="stylesheet" type="text/css" href="assets/plugins/datepicker/DateTimePicker.css">
<script type="text/javascript" src="assets/plugins/datepicker/DateTimePicker.js"></script>
<body>
<?php
include "include/zahlavi.php";
include "include/menu.php";?>
<script type="text/javascript" src="js/registrace.js"></script>

    <script>
$.fn.Dropdown = function(id) {
$("."+id).toggle();
};
</script>

<div class="cont text">
<h2>Najdi top termín</h2>

    <form action="find-termin-output" method="post">
    <input type="hidden" name="token" value="<?php echo $token; ?>" />
    <table align="center">
<tr>
	<td>Interval od:</td>
	<td><input class="startDateTime1" type="text" data-field="datetime" data-startend="start" data-startendelem=".endDateTime1" name="od" required></td>
</tr>

<tr>
	<td>Interval do:</td>
	<td><input class="endDateTime1" type="text" data-field="datetime" data-startend="end" data-startendelem=".startDateTime1" name="do" required></td>
    </tr>

<tr>
    <td>Kolik dní bude akce trvat:</td>
    <td><input type="number" name="dni" value="dni" min="1" max="20" required></td>
</tr>

<tr>
<td>Pozvat:</td>
<td>
    <div id="naseptavac" onclick="$(this).Dropdown('naseptavacDropdown');">
    <div><i class="fa fa-caret-right nastaveniEmail"></i><i class="fa fa-caret-down nastaveniEmail" style="display:none"></i>Nabídka</div>
</div>
<div id="naseptavac" class="naseptavacDropdown" style="display:none">
    <table>
        <?php
$event_find_termin = new Event();
$event_find_termin->event_user_choice();
?>
    </table>
</div>
</td>
</tr>

		<div id="dtBox"></div>

		<script type="text/javascript">
			$(document).ready(function(){
				$("#dtBox").DateTimePicker(
				{minuteInterval: 15}
			);});

		</script>
<tr><td colspan="2" align="center"><button type="submit" name="najit-termin">Poslat</button></td></tr>
</table>
    </form>
</div>
</body>
</html>