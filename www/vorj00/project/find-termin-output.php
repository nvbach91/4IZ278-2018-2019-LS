<html>
<?php
$title = "Najít top termín";
?>

<head>
    <?php include "include/head.php";?>
    <link rel="stylesheet" href="assets/css/find-term-output.css">
</head>

<body>
    <?php

if (!isset($_POST['najit-termin'])) {
    header("location: find-termin");
} else {
    include "include/zahlavi.php";
    include "include/menu.php";

    $find_termin = new Termin();
    ?>

    <script type="text/javascript" src="assets/js/registrace.js"></script>
    <div class="cont text">
        <h2>Vhodný termín</h2>
        <div class="nastaveniIcons">
            <div class="nastaveniIconsCont" onclick="$(this).Dropdown('zadano');">
                <i class="fa fa-caret-right zadano"></i>
                <i class="fa fa-caret-down zadano display-none"></i> Zadané
                údaje</div>
            <div class="zadano display-none">
                <?php
$find_termin->termin_input_data();
    $find_termin->termin_input_data_echo();
    ?>
                <hr>
            </div>
        </div>
        <div>Možnosti:</div>
        <?php
$find_termin->termin_output_data_echo();
}?>
    </div>
    <script>
    $.fn.Dropdown = function(id) {
        $("." + id).toggle();
    };
    </script>
</body>

</html>