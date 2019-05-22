<?php

session_start();
require 'db.php';

$errors = [];

if ('POST' == $_SERVER['REQUEST_METHOD']) {
    $first_name = $_POST['first_name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $check_password = $_POST['check_password'];

    if (!$first_name || !$surname || !$email || !$phone || !$password || !$check_password){
        array_push($errors, 'Doplňte chybějící údaje');
    }else{
        if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
            array_push($errors,'Vyplňte e-mail ve správném formátu');
        }
        if (!preg_match('/^.{9,}$/', $password)){
            array_push($errors, 'Heslo musí mít alespoň 9 znaků');
        }
        if (!preg_match('/^\+[1-9][0-9]{1,2}[0-9]{9}$/', $phone)){
            array_push($errors, 'Telefonní číslo vyplňte ve tvaru +420123456789');
        }
        if ($password !== $check_password){
            array_push($errors, 'Uvedená hesla se neshodují');
        }
    }

    if(!count($errors)){      
        //register
        $emailExists=$usersDB->fetch('email', $email);
        if($emailExists){
            array_push($errors, 'Tento e-mail je u nás již registrován');
        }else{
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $usersDB->create(['first_name'=>$first_name,
            'surname'=>$surname,
            'email'=>$email,
            'phone'=>$phone,
            'password'=>$hashedPassword]);

            $user = $usersDB->fetch('email', $email);
            if(!$user){
                die('Při registraci nastala chyba');
            }
            $_SESSION['userID'] = $user[0]['user_id'];
            $_SESSION['email'] = $user[0]['email'];
            $_SESSION['role'] = $user[0]['role'];
           
            header('Location: mail.php?recipient='.$_SESSION['email'].'&mail=Registrace');
        }        
    }    
}
?>

<?php require __DIR__ . '/components/header.php' ?>
<main class="container">
    <h1>Registrace</h1>
    <form class="form-signin" method="POST">
        <?php if(count($errors)): ?>
            <div class="alert alert-danger">
                  <?php foreach($errors as $error): ?>
                  <p><?php echo $error; ?></p>
                  <?php endforeach ?>
            </div>
         <?php endif ?>
        <div class="form-label-group">
            <label for="first_name">Křestní jméno</label>
            <input name="first_name" class="form-control" placeholder="Jan" autofocus value="<?php echo @$first_name; ?>">
        </div>
        <div class="form-label-group">
            <label for="surname">Příjmení</label>
            <input name="surname" class="form-control" placeholder="Novák" value="<?php echo @$surname; ?>">
        </div>
        <div class="form-label-group">
            <label for="email">E-mail</label>
            <input name="email" class="form-control" placeholder="jan.novak@gmail.com" value="<?php echo @$email; ?>">
        </div>
        <div class="form-label-group">
            <label for="phone">Telefon</label>
            <input name="phone" class="form-control" placeholder="+420123456789" value="<?php echo @$phone; ?>">
        </div>
        <div class="form-label-group">
            <label for="password">Heslo</label>
            <input type="password" name="password" class="form-control" value="<?php echo @$password; ?>">
        </div>
        <div class="form-label-group">
            <label for="check_password">Potvrzení hesla</label>
            <input type="password" name="check_password" class="form-control" value="<?php echo @$check_password; ?>">
        </div>
        <br>
        <button class="btn btn-dark" type="submit">Vytvořit účet</button>
    </form>
</main>
<div style="margin-bottom: 300px"></div>
<?php require __DIR__ . '/components/footer.php' ?>