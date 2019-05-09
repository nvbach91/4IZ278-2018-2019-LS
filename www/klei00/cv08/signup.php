<?php

session_start();
require 'db.php';

$errors = [];

if ('POST' == $_SERVER['REQUEST_METHOD']) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!$email){
        array_push($errors, 'Write your email, please!');
    }else{
        if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
            array_push($errors,'Please use a valid email!');
        }
    }
    if (!$password){
        array_push($errors, 'Please enter your password!');
    }else{
        if (!preg_match('/^.{9,}$/', $password)){
            array_push($errors, 'Password must have at least 9 characters!');
        }
    }

    if(!count($errors)){      
        //register
        $emailExists=$usersDB->fetch('email', $email);
        if($emailExists){
            array_push($errors, 'This email is already registered!');
        }else{
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $usersDB->create(['email'=>$email, 'password'=>$hashedPassword]);

            $user = $usersDB->fetch('email', $email);
            if(!$user){
                die('Registration Error');
            }
            $_SESSION['userID'] = $user[0]['id'];
            $_SESSION['email'] = $user[0]['email'];
            header('Location: index.php?signup');
        }        
    }    
}
?>

<?php require __DIR__ . '/components/header.php' ?>
<main class="container">
    <h1>New Signup</h1>
    <form class="form-signin" method="POST">
        <?php if(count($errors)): ?>
            <div class="alert alert-danger">
                  <?php foreach($errors as $error): ?>
                  <p><?php echo $error; ?></p>
                  <?php endforeach ?>
            </div>
         <?php endif ?>
        <div class="form-label-group">
            <label for="email">Email</label>
            <input name="email" class="form-control" placeholder="E-mail" autofocus value="<?php echo @$email; ?>">
        </div>
        <div class="form-label-group">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control" placeholder="Password" value="<?php echo @$password; ?>">
        </div>
        <br>
        <button class="btn btn-dark" type="submit">Creat account</button>
    </form>
</main>
<div style="margin-bottom: 600px"></div>
<?php require __DIR__ . '/components/footer.php' ?>