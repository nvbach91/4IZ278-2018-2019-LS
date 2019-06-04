<?php
require 'user_req.php';

if((int)$logged_user[0]['privilege'] < 2){
    die('Access denied. You do not have sufficient privileges.');
}

?>