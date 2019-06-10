<?php
if (!isset($_SESSION['band_id'])) {
    header('Location: user_profile.php?user_id=' . $_SESSION['user_id']);
}

