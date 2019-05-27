<?php
// třída pro přihlášení a registraci
class Login
{
    // email
    public $email;
    // password
    private $password;
    // pro přihlášení
    public function login_connect()
    {
        global $con;
        // získám údaje z přihlašovacího formuláře
        $email = strip_tags(@$_POST['loginEmail']);
        $email = $con->real_escape_string($email);
        $password = $con->real_escape_string(@$_POST['loginPassword']);
        // vezmu mail, který uživatel zadal
        $loginQuery = $con->query("select * from users where email='$email'");
        // a z daného uživatele si vezmu mail a password
        $row = $loginQuery->fetch_assoc();
        $id = $row['id'];
        $passwordDat = $row['password'];
        // když password sedí
        if (password_verify($password, $passwordDat)) {
            // spočítám, jestli je opravdu jen jeden - kvůli možné SQL injection
            $loginQueryNum = $loginQuery->num_rows;
            // a když je jeden
            if ($loginQueryNum === 1) {
                // vytvořím z něj $_SESSION[] a refreshnu
                $_SESSION['user_id'] = $id;
                header("location:index");
            }
        }
    }
    // pro registrace
    public function login_registration()
    {
        global $con;
        // vezmu údaje z formuláře a případně očistím je o možné omyly/SQL injection
        $first_name = mb_convert_case(strip_tags(@$_POST['first_name']), MB_CASE_TITLE, "UTF-8");
        $last_name = mb_convert_case(strip_tags(@$_POST['last_name']), MB_CASE_TITLE, "UTF-8");
        $email = strip_tags(@$_POST['email']);
        $password = strip_tags(@$_POST['password']);
        // zahashuju password
        $password = password_hash($password, PASSWORD_DEFAULT);
        // kouknu, jestli se v databázi už objevuje daný e-mail
        $pocetmailu_query = $con->query("SELECT email FROM users where email='$email'");
        // spočítám řady
        $pocetmailu = $pocetmailu_query->num_rows;
        // když je vše ok, pokračuji
        if ($pocetmailu == 0) {
            // opět zamezuju SQL injection a zároveň přidávám do databáze data
            if ($stmt = $con->prepare("insert into users values ('',?,?,?,?,'','user_data/profile-pic/default.png','')")) {
                $stmt->bind_param("ssss", $first_name, $last_name, $email, $password);
                $stmt->execute();
                $stmt->close();
            }
            // nakonec se kouknu do databáze, kde už je nový účet, vemu e-mail a přihlásím se
            if ($stmt = $con->prepare("select id from users where email=?")) {
                $stmt->bind_param("s", $email);
                $stmt->execute();
                $stmt->bind_result($id);
                $stmt->fetch();
                $stmt->close();
            }
            // údaje uložím do $_SESSION[] a refreshuji
            $_SESSION['user_id'] = $id;
            header("location:index.php");
        }
    }

    public function fb_login($user, $photo)
    {
        global $con;
        $name = explode(' ', $user['name']);
        $first_name = implode(' ', array_slice($name, 0, -1));
        $last_name = end($name);
        $email = $user['email'];

        // kouknu, jestli se v databázi už objevuje daný e-mail
        $pocetmailu_query = $con->query("SELECT email FROM users where email='$email'");
        // spočítám řady
        $pocetmailu = $pocetmailu_query->num_rows;        // když je vše ok, pokračuji
        if ($pocetmailu === 0) {
            // opět zamezuju SQL injection a zároveň přidávám do databáze data
            if ($stmt = $con->prepare("insert into users values ('',?,?,?,'','',?,'')")) {
                $stmt->bind_param("ssss", $first_name, $last_name, $email, $photo);
                $stmt->execute();
                $stmt->close();
            }
        }
        // nakonec se kouknu do databáze, kde už je nový účet, vemu e-mail a přihlásím se
        if ($stmt = $con->prepare("select id from users where email=?")) {
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->bind_result($id);
            $stmt->fetch();
            $stmt->close();
        }
        // údaje uložím do $_SESSION[] a refreshuji
        $_SESSION['user_id'] = $id;
        header("location:index.php");
    }
}