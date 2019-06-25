<?php
require 'db.php';

require 'logged_in_required.php';

require 'band_required.php';

$user_id = $_GET['user_id'];
$band_id = $_SESSION ['band_id'];

$stmt = $db->prepare('DELETE FROM band_members WHERE users_user_id= :users_user_id; ');
$stmt->execute([
    'users_user_id' => $user_id,
]);

header('Location: user_profile.php?user_id=' . $user_id);