<html>
<?php
$title = "Naplánovat akci";
include "include/head.php";
?>
<link rel="stylesheet" type="text/css" href="assets/plugins/datepicker/DateTimePicker.css">
<script type="text/javascript" src="assets/plugins/datepicker/DateTimePicker.js"></script>
<body>

<script>
$.fn.Dropdown = function(id) {
$("."+id).toggle();
};
</script>

<?php
include "include/zahlavi.php";
include "include/menu.php";?>

<div class="cont">
<form class="naplanovat" method="post" action="vytvorit-udalost.php" enctype="multipart/form-data">
<input type="hidden" name="token" value="<?php echo $token; ?>" />
<table align="center">
<tr>
	<td>Název:</td>
	<td><input name="nazev" required></td>
</tr>

<tr>
	<td>Foto na pozadí:</td>
	<td><input name="foto" type="file"></td>
</tr>

<tr>
	<td>Kde:</td>
	<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA2JRsX5_FNelQLiRtywO4p4TaE3GOTe14&libraries=places"></script>
        <script>
            var autocomplete;
            window.onload = function initialize() {
              autocomplete = new google.maps.places.Autocomplete(
                  (document.getElementById('autocomplete')),
                  {});
              google.maps.event.addListener(autocomplete, 'place_changed', function() {
              });
            }
        </script>
    <script src="js/jsNaplanovat.js"></script>
	<td><div id="locationField">
          <input id="autocomplete" name="kde" type="text" placeholder="" required>
        </div></td>
</tr>

<tr>
	<td>Od:</td>
	<td><input class="startDateTime1" type="text" data-field="datetime" data-startend="start" data-startendelem=".endDateTime1" name="od" required></td>
</tr>

<tr>
	<td>Do:</td>
	<td><input class="endDateTime1" type="text" data-field="datetime" data-startend="end" data-startendelem=".startDateTime1" name="do" required></td>
    </tr>

<tr>
	<td>Popis:</td>
	<td><textarea name="co"></textarea></td>
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
$event_plane = new Event();
$event_plane->event_user_vyber();
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
<tr><td colspan="2" align="center"><button type="submit" name="vytvorit">Hotovo</button></td></tr>
</table>
</form>
</div>
</body>
</html>