<html>
<?php
$title = "Naplánovat akci";
?>

<head>
    <?php include "include/head.php";?>
    <link rel="stylesheet" type="text/css" href="assets/plugins/datepicker/DateTimePicker.css">
</head>


<body>

    <script>
    $.fn.Dropdown = function(id) {
        $("." + id).toggle();
    };
    </script>

    <?php
include "include/zahlavi.php";
include "include/menu.php";?>

    <div class="cont">
        <form class="naplanovat" method="post" action="vytvorit-udalost.php" enctype="multipart/form-data">
            <input type="hidden" name="token" value="<?php echo $token; ?>" />
            <table>
                <tr>
                    <td>Název:</td>
                    <td><input name="nazev" required></td>
                </tr>

                <tr>
                    <td>Foto na pozadí:</td>
                    <td><input name="photo" type="file"></td>
                </tr>

                <tr>
                    <td>Kde:</td>
                    <script src="assets/js/jsNaplanovat.js"></script>
                    <td>
                        <div id="locationField">
                            <input id="autocomplete" name="kde" type="text" placeholder="" required>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td>Od:</td>
                    <td><input class="startDateTime1" type="datetime-local" name="od" required></td>
                </tr>

                <tr>
                    <td>Do:</td>
                    <td><input class="endDateTime1" type="datetime-local" name="do" required></td>
                </tr>

                <tr>
                    <td>Popis:</td>
                    <td><textarea name="co"></textarea></td>
                </tr>

                <tr>
                    <td>Pozvat:</td>
                    <td>
                        <div id="naseptavac" onclick="$(this).Dropdown('naseptavacDropdown');">
                            <div><i class="fa fa-caret-right nastaveniEmail"></i><i
                                    class="fa fa-caret-down nastaveniEmail" style="display:none"></i>Nabídka</div>
                        </div>
                        <div id="naseptavac" class="naseptavacDropdown" style="display:none">
                            <table>
                                <?php
$event_plane = new Event();
$event_plane->event_user_choice();
?>
                            </table>
                        </div>
                    </td>
                </tr>

                <div id="dtBox"></div>

                <script type="text/javascript">
                $(document).ready(function() {
                    $("#dtBox").DateTimePicker({
                        minuteInterval: 15
                    });
                });
                </script>
                <tr>
                    <td colspan="2"><button type="submit" name="vytvorit">Hotovo</button></td>
                </tr>
            </table>
        </form>
    </div>
    <script type="text/javascript" src="assets/plugins/datepicker/DateTimePicker.js"></script>
</body>

</html>