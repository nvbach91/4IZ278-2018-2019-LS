<?php
require 'db.php';

require 'logged_in_required.php';

require 'band_required.php';


$user_id = $_GET['user_id'];
$band_id = $_SESSION ['band_id'];

$stmt = $db->prepare('insert into band_members (users_user_id, bands_band_id) VALUES (:users_user_id, :bands_band_id);');
$stmt->execute([
    'users_user_id' => $user_id,
    'bands_band_id' => $band_id
]);

header('Location: user_profile.php?user_id=' . $user_id);


