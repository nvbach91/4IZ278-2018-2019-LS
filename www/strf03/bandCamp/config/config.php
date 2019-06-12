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
function is_in_array($array, $key, $key_value)
{
    $within_array = false;
    foreach ($array as $k => $v) {
        ## array in_array
        if (is_array($v) == !false) {
            $within_array = is_in_array($v, $key, $key_value);
            if ($within_array == false) {
                break;
            }
        } else {
            if ($v == $key_value && $k == $key) {
                $within_array = true;
                break;
            }
        }
        ## END ## in_array
    }
    ## END forearch
    return $within_array;
}
$DEFAULT_AVATAR = 'no_profile.jpg';

$districts = array("Praha", "Středočeský", "Jihočeský",
    "Plzeňský", "Karlovarský", "Ústecký", "Liberecký", "Královéhradecký", "Pardubický",
    "Vysočina", "Jihomoravský", "Olomoucký", "Zlínský", "Moravskoslezský");