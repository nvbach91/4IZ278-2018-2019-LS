<html>
<?php
$title = "Nastavení";
include "include/head.php";
?>

<body>
    <?php
include "include/zahlavi.php";
include "include/menu.php";
?>

    <script type="text/javascript" src="js/registrace.js"></script>
    <?php

//osobní údaje
if (isset($_POST['updatename'])) {
    $user_id->user_update_name();
}

//email
if (isset($_POST['updateEmail'])) {
    $user_id->user_update_email();
}

//profil_obr
if (isset($_FILES['profilepic'])) {
    $user_id->user_update_profilepic();
}

//password
if (isset($_POST['password'])) {
    $user_id->user_update_password();
}

?>
    <div class="cont text">
        <h2>Nastavení</h2>
        <div class="nastaveniIcons">
            <div class="nastaveniIconsCont" onclick="$(this).Dropdown('nastaveniOsobni');">
                <div><i class="fa fa-caret-right nastaveniOsobni"></i><i class="fa fa-caret-down nastaveniOsobni"
                        style="display:none"></i> Osobní údaje</div>
                <div><?php echo $user_id->first_name; ?> <?php echo $user_id->last_name; ?></div>
            </div>
            <div class="nastaveniOsobni" style="display:none">
                <form action="settings.php" method="post">
                    <input type="hidden" name="token" value="<?php echo $token; ?>" />
                    Křestní jméno:<input type="text" name="first_name" id="first_name"
                        value="<?php echo $user_id->first_name; ?>"><br>
                    Příjmení:<input type="text" name="last_name" id="last_name"
                        value="<?php echo $user_id->last_name; ?>"><br>
                    <br>
                    <input type="submit" name="updatename" id="updatename" value="Aktualizovat">
                </form>
            </div>

            <div class="nastaveniIconsCont" onclick="$(this).Dropdown('nastaveniEmail');">
                <div><i class="fa fa-caret-right nastaveniEmail"></i><i class="fa fa-caret-down nastaveniEmail"
                        style="display:none"></i> E-mail</div>
                <div><?php echo $user_id->email; ?></div>
            </div>
            <div class="nastaveniEmail" style="display:none">
                <form action="settings.php" method="post">
                    <input type="hidden" name="token" value="<?php echo $token; ?>" />
                    Nový mail:<input type="email" name="email" id="email" value="<?php echo $user_id->email; ?>"><br>
                    <br>
                    <input type="submit" name="updateEmail" id="updateEmail" value="Aktualizovat">
                </form>
            </div>

            <div class="nastaveniIconsCont" onclick="$(this).Dropdown('nastaveniProfilovy');">
                <div><i class="fa fa-caret-right nastaveniProfilovy"></i><i class="fa fa-caret-down nastaveniProfilovy"
                        style="display:none"></i> Profilový obrázek</div>
                <div><img src="<?php echo $user_id->profile_pic; ?>"></div>
            </div>
            <div class="nastaveniProfilovy" style="display:none">
                <form action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="token" value="<?php echo $token; ?>" />
                    <img src="<?php echo $user_id->profile_pic; ?>" width="70">
                    <input type="file" name="profilepic"><br>
                    <input type="submit" name="uploadpic" value="Nahraj"><br>
                </form>
            </div>

            <div class="nastaveniIconsCont" onclick="$(this).Dropdown('nastaveniHeslo');">
                <div><i class="fa fa-caret-right nastaveniHeslo"></i><i class="fa fa-caret-down nastaveniHeslo"
                        style="display:none"></i> Heslo</div>
            </div>
            <div class="nastaveniHeslo" style="display:none">
                <form method="post">
                    <input type="hidden" name="token" value="<?php echo $token; ?>" />
                    Staré heslo:<input type="password" name="oldpassword" id="oldpassword" autocomplete="off"><br>
                    Nové heslo:<input type="password" name="password1" id="password1"><br>
                    Nové heslo znova:<input type="password" name="password2" id="password2"><br>
                    <input type="submit" name="password" id="password" value="Aktualizovat">
                </form>
            </div>

            <div class="nastaveniIconsCont" onclick="$(this).Dropdown('nastaveniOdstranit');">
                <div><i class="fa fa-caret-right nastaveniOdstranit"></i><i class="fa fa-caret-down nastaveniOdstranit"
                        style="display:none"></i> Odstranit účet</div>
            </div>
            <div class="nastaveniOdstranit" style="display:none">
                <form action="odstranit-ucet.php" method="post">
                    <input type="hidden" name="token" value="<?php echo $token; ?>" />
                    <p>Upozornění: Váš účet bude trvale odstraněn a již nebude možné se k němu vrátit. Vytvoření účtu se
                        stejnými údaji však možné bude.</p>
                    <input type="submit" name="closeaccount" id="closeaccount" value="Odstranit účet">
                </form>
            </div>
        </div>

        <script>
        $.fn.Dropdown = function(id) {
            $("." + id).toggle();
        };
        </script>


    </div>
</body>

</html>