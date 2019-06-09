<?php 
session_start();
require 'db.php';

$errors = [];

if ('POST' == $_SERVER['REQUEST_METHOD']) {
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $formPassword = $_POST['password'];

    if (!$name){
        array_push($errors, 'Zadejte své jméno, prosím!');
    }
    if (!$surname){
        array_push($errors, 'Zadejte své příjmení, prosím!');
    }
    if (!$email){
        array_push($errors, 'Zadejte svoji e-mailovou adresu, prosím!');
    }else{
        if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
            array_push($errors,'Vaše e-mailová adresa není validní!');
        }
    }
    if (!$formPassword){
        array_push($errors, 'Zadejte své heslo, prosím!');
    }else{
        if (!preg_match('/^.{9,}$/', $formPassword)){
            array_push($errors, 'Heslo musí mít nejméně 9 znaků!');
        }
    }
    if(!count($errors)){      
        $emailControl=$usersDB->fetchBy('email', $email);
        if($emailControl){
            array_push($errors, 'Tento email je již zaregistrovaný!');
        }else{
            //$hashPassword = password_hash($formPassword, PASSWORD_DEFAULT);
            $usersDB->create(['name'=>$name,'surname'=>$surname,'email'=>$email, 'password'=>$formPassword,'privilege'=> 1]);
            $user = $usersDB->fetchBy('email', $email);
            var_dump($user);
            if(!$user){
                die('Chyba registrace');
            }
            $_SESSION['id'] = $user[0]['users_id'];
            $_SESSION['email'] = $user[0]['email'];
            header('Location: email.php?recipient='.$_SESSION['email'].'&email=Registrace');
        }        
    }    
}


?>
<?php require __DIR__ . '/incl/header.php'; ?>
<?php require __DIR__ . '/incl/navbar.php'; ?>
<main class="container">
    <br>
    <h1 class="text-center">Registrace</h1>
    <div class="row justify-content-center">
        <form class="form-registration" method="POST">
            <?php if(count($errors)): ?>
                <div class="alert alert-danger">
                    <?php foreach($errors as $error): ?>
                    <p><?php echo $error; ?></p>
                    <?php endforeach ?>
                </div>
            <?php endif ?>
            <div class="form-group">
                <label>Jméno</label>
                <input class="form-control" placeholder="Jméno" name="name" value="<?php echo @$name; ?>">
                <small class="text-muted">Example: Jan </small>
            </div>
            <div class="form-group">
                <label>Příjmení</label>
                <input class="form-control" placeholder="Jméno" name="surname" value="<?php echo @$surname; ?>">
                <small class="text-muted">Example: Novák </small>
            </div>
            <div class="form-group">
                <label>Email*</label>
                <input class="form-control" placeholder="e-mail"  name="email" value="<?php echo @$email; ?>" type="email">
                <small class="text-muted">Example: jan@email.cz</small>
            </div>
            <div class="form-group">
                <label>Heslo* (Délka alespoň 8 znaků)</label>
                <input class="form-control" name="password" value="<?php echo @$formPassword; ?>" type="password">
            </div>
            <button class="btn btn-primary text-center" type="submit">Potvrdit</button>
        </form>
    </div>
</main>
<?php require __DIR__ . '/incl/footer.php'; ?>