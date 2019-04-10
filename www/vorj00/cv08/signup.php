<?php
session_start();

require 'db.php';

$errors = [];

if ('POST' == $_SERVER['REQUEST_METHOD']) {
    $email = @$_POST['email'];
    $password = @$_POST['password'];
    // TODO PRO STUDENTY osetrit vstupy, email a heslo jsou povinne, atd.
    if(isset($email)) {
        $errors['email'] = true;
    }
    if(isset($password)) {
        $errors['password'] = true;
    }
    // TODO PRO STUDENTY jde se prihlasit prazdnym heslem, jen prototyp, pouzit filtry
    // $password = md5($_POST['password']); #chybi salt
    // $password = hash("sha256" , $password); #chybi salt
    // viz http://php.net/manual/en/function.password-hash.php
    // salt lze generovat rucne (nedoporuceno), nebo to nechat na php, ktere salt rovnou pridat do hashovaneho hesla
    /**
     * We just want to hash our password using the current DEFAULT algorithm.
     * This is presently BCRYPT, and will produce a 60 character result.
     *
     * Beware that DEFAULT may change over time, so you would want to prepare
     * By allowing your storage to expand past 60 characters (255 would be product)
     */
    // dalsi moznosti je vynutit bcrypt: PASSWORD_BCRYPT
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    //vlozime usera do databaze
    $stmt = $db->prepare('INSERT INTO users(email, password) VALUES (:email, :password)');
    $stmt->execute([
        'email' => $email,
        'password' => $hashedPassword,
    ]);
    //ted je uzivatel ulozen, bud muzeme vzit id posledniho zaznamu pres last insert id (co kdyz se to potka s vice requesty = nebezpecne),
    // nebo nacist uzivatele podle mailove adresy (ok, bezpecne)
    $stmt = $db->prepare('SELECT id FROM users WHERE email = :email LIMIT 1'); //limit 1 jen jako vykonnostni optimalizace, 2 stejne maily se v db nepotkaji
    $stmt->execute([
        'email' => $email,
    ]);
    $user_id = (int) $stmt->fetchColumn();
    $_SESSION['user_id'] = $user_id;
    header('Location: index.php');
}
?>

<?php require './incl/header.php';?>
   <?php include './incl/nav.php';?>
<main class="container">
    <h1>PHP Shopping App</h1>
    <h2>New Signup</h2>
    <form class="form-signin" method="POST">
        <div class="form-label-group">
            <label for="email">Email address</label>
            <input type="email" name="email" class="form-control" placeholder="Email address"  autofocus>
            <?php if(isset($errors['email'])): ?>
            <div class="alert alert-warning">
                <strong>Warning!</strong> Insert your e-mail, pls.
            </div>
            <?php endif; ?>
        </div>
        <div class="form-label-group">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control" placeholder="Password">
            <?php if(isset($errors['password'])): ?>
            <div class="alert alert-warning">
                <strong>Warning!</strong> Insert a password, please.
            </div>
            <?php endif; ?>
        </div>
        <br>
        <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Creat account</button>
    </form>
</main>
<?php require './incl/footer.php';?>