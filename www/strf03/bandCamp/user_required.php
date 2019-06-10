<?php

if (!isset($_SESSION['user_id'])) {
    header('Location: band_profile.php?band_id=' . $_SESSION['band_id']);
}