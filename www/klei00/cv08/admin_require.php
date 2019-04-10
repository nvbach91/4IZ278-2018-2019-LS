<?php
require 'user_require.php';
if((int)$current_user[0]['privilege'] < 3){
    die('Access denied. You do not have sufficient privileges.');
}
?>