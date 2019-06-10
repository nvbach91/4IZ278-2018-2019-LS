<?php
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function redirect()
{
    if (isset($_SESSION['user_id'])) {
        header('Location: user_profile.php?user_id=' . $_SESSION['user_id']);
    }
    if (isset($_SESSION['band_id'])) {
        header('Location: band_profile.php?band_id=' . $_SESSION['band_id']);
    }
}

$DEFAULT_AVATAR = 'no_profile.jpg';

$districts = array("Praha", "Středočeský", "Jihočeský",
    "Plzeňský", "Karlovarský", "Ústecký", "Liberecký", "Královéhradecký", "Pardubický",
    "Vysočina", "Jihomoravský", "Olomoucký", "Zlínský", "Moravskoslezský");