<html>
<?php
require_once "./include/connect.php";
$profile_id = $_GET['id'];
$profile_user = new User();
$profile_user->id = $profile_id;
$profile_user->user_data();

$title = "$profile_user->first_name $profile_user->last_name — Profil";
?>

<head>
    <?php include "include/head.php";?>
</head>

<body>
    <?php
include "include/zahlavi.php";
include "include/menu.php";

?>
    <div class="cont">
        <div id="userCard">
            <div>
                <h2><?php echo $profile_user->first_name . ' ' . $profile_user->last_name; ?></h2>
            </div>
            <div><img src="<?php echo $profile_user->profile_pic; ?>" width="100%"></div>
            <div>
                <?php
$profile_user->user_profile();
?>
            </div>
        </div>
    </div>
</body>

</html>