<?php 

require './utils.php';

$invalidInputs = [];
$alertMessages = [];
$alertType = 'alert-danger';

// check if form is submitted
$submittedForm = !empty($_POST);
if ($submittedForm) {
    // get all fields while trimming them and converting any special chars to html entities
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $avatar = htmlspecialchars(trim($_POST['avatar']));

    // check for empty name
    if (!$name) {
        array_push($alertMessages, 'Please enter your name');
        array_push($invalidInputs, 'name');
    }

    // if no errors yet: check for bad email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($alertMessages, 'Please use a valid email');
        array_push($invalidInputs, 'email');
    }

    // if no errors yet: check for bad phone numbers
    if (!preg_match('/^(\+\d{3} ?)?(\d{3} ?){3}$/', $phone)) {
        array_push($alertMessages, 'Please use a valid phone number');
        array_push($invalidInputs, 'phone');
    }

    // if no errors yet: check for avatar URL
    if (!filter_var($avatar, FILTER_VALIDATE_URL)) {
        array_push($alertMessages, 'Please use a valid URL for your avatar');
        array_push($invalidInputs, 'avatar');
    }

    // if no errors yet: send an email
    //if (!sendEmail(['recipient' => $email, 'subject' => 'Registration confirmation'])) {
    //    $alertMessage = 'There was a problem sending email';
    //}

    // if no errors at all: display success
    if (!count($alertMessages)) {
        $alertType = 'alert-success';
        $alertMessages = ['Woohoo! You have successfully signed up!'];
    }
}

?>
<?php require './components/header.php'; ?>
<main class="container">
    <br>
    <h1 class="text-center">Form validation example</h1>
    <h2 class="text-center">Registration form</h2>
    <div class="row justify-content-center">
        <form class="form-signup" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <?php if ($submittedForm): ?>
            <div class="alert <?php echo $alertType; ?>"><?php echo implode('<br>', $alertMessages); ?></div>
            <?php endif; ?>
            <div class="form-group">
                <label>Name*</label>
                <input class="form-control<?php echo in_array('name', $invalidInputs) ? ' is-invalid' : '' ?>" name="name" value="<?php echo isset($name) ? $name : '' ?>">
            </div>
            <div class="form-group">
                <label>Email*</label>
                <input class="form-control<?php echo in_array('email', $invalidInputs) ? ' is-invalid' : '' ?>" name="email" value="<?php echo isset($name) ? $email : '' ?>">
            </div>
            <div class="form-group">
                <label>Phone*</label>
                <input class="form-control<?php echo in_array('phone', $invalidInputs) ? ' is-invalid' : '' ?>" name="phone" value="<?php echo isset($phone) ? $phone : '' ?>">
            </div>
            <div class="form-group">
                <label>Avatar URL*</label>
                <?php if (isset($avatar) && $avatar): ?>
                <img class="avatar" src="<?php echo $avatar; ?>" alt="avatar">
                <?php endif; ?>
                <input class="form-control<?php echo in_array('avatar', $invalidInputs) ? ' is-invalid' : '' ?>" name="avatar" value="<?php echo isset($avatar) ? $avatar : ''; ?>">
                <small class="text-muted">http://interactive.nydailynews.com/2016/05/simpsons-quiz/img/simp1.jpg</small>
            </div>
            <button class="btn btn-primary" type="submit">Submit</button>
        </form>
    </div>
</main>
<?php require './components/footer.php'; ?>