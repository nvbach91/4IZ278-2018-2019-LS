<?php
/*přihlašovací/registrační stránka*/
//na náhodný obrázek
$bg = range(1, 5); // array of filenames
$i = rand(0, count($bg) - 1); // generate random number size of the array
$selectedBg = "$bg[$i]"; // set variable equal to which random filename was chosen
$selectedBg .= ".jpg";
?>
<html>
<?php
$title = "Přihlášení";
?>

<head>
    <?php include "include/head.php";?>
    <link rel="stylesheet" href="assets/css/login.css">
</head>

<body>
    <style type="text/css">
    .centerdiv {
        background-image: url("assets/img/homepage-background/<?php echo $selectedBg; ?>");
    }
    </style>

    <?php
include "include/fb-login-helper.php";
include "include/zahlavilogin.php";

$login = @$_POST['loginSubmit'];
$registrace = @$_POST['registrovat'] || @$_POST['registrace'];

if (!empty($_POST['token'])) {
    if (hash_equals($_SESSION['token'], $_POST['token'])) {

        if (isset($login)) {
            $check_login = new Login();
            $check_login->login_connect();
        }

        if (isset($registrace)) {
            $registrace_login = new Login();
            //$registrace_login->login_registration();
            $registerRespond = $registrace_login->login_registration();
            //echo "aaa " . sizeof($registerRespond);
        }
    } else {
        echo "Neplatný token, odešlete prosím formulář znovu.\n";
    }
}
?>

    <div class="document centerdiv">
        <form name="registrace" method="post">
            <input type="hidden" name="token" value="<?php echo $token; ?>" />
            <table>
                <tr>
                    <td colspan="2">
                        <h2>Registrace</h2>
                </tr>
                <tr>
                    <td>
                        <input type="text" name="first_name" id="jmeno" placeholder="Jméno"
                            value="<?php echo @$_POST['first_name'] ?>" required>
                        <?php echo "<span>" . @$registerRespond['first_name'] . "</span>"; ?>
                    </td>
                    <td>
                        <input type="text" name="last_name" id="last_name" placeholder="Příjmení"
                            value="<?php echo @$_POST['last_name'] ?>" required>
                        <?php echo "<span>" . @$registerRespond['last_name'] . "</span>"; ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="email" name="email" placeholder="E-mail" id="email"
                            value="<?php echo @$_POST['email'] ?>" required>
                        <?php echo "<span>" . @$registerRespond['email'] . "</span>"; ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="email" name="email2" placeholder="E-mail znova" id="confirm_email"
                            onpaste="return false" value="<?php echo @$_POST['email2'] ?>" required>
                        <?php echo "<span>" . @$registerRespond['email2'] . "</span>"; ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="password" name="password" placeholder="Heslo" id="password" required>
                        <?php echo "<span>" . @$registerRespond['password'] . "</span>"; ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" id="registrovat" name="registrovat" value="Registrovat"></td>
                </tr>
                <tr>
                    <td colspan="2"><a href="<?php echo $FBloginUrl ?>">Nah, raději FB</a>
                    </td>
                </tr>
            </table>
        </form>
    </div>
    <!-- <script type="text/javascript" src="assets/js/registrace.js"></script> -->
</body>

</html>