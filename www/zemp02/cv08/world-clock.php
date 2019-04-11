<?php
require './Header.php';
require './Navbar.php';

date_default_timezone_set("Europe/Prague");
echo "Prague:".date("d. m. Y H:s"). " Base time.";
echo "<br>";

date_default_timezone_set("Asia/Tokyo");
echo "Tokyo:".date("Y年m月d日 H:s")." Time difference: +7 Hours";
echo "<br>";

date_default_timezone_set("Europe/Helsinki");
echo "Helsinki:".date("d.m.Y H:s")." Time difference: +1 Hour";
echo "<br>";

date_default_timezone_set("Asia/Singapore");
echo "Singapore:".date("Y年m月d日 H:s")." Time difference: +6 Hours";
echo "<br>";

date_default_timezone_set("America/New_York");
echo "New York:".date("m/d/y H:s")." Time difference: -6 Hours";
echo "<br>";





require './Footer.php';