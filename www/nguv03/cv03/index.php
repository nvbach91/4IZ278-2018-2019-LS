<?php 

$alertMessage = '';
$alertType = 'alert-danger';

// check if form is submitted
$submittedForm = !empty($_POST);
if ($submittedForm) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    
    // check for empty fields one by one
    $fields = ['name', 'email', 'phone'];
    foreach ($fields as $field) {
        $fieldValue = $_POST[$field];
        if (!$fieldValue) {
            $alertMessage = "Please insert $field";
            break;
        }
    }

    // if no errors yet: check for bad email
    if (!$alertMessage && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $alertMessage = 'Please use a valid email';
    }

    // if no errors yet: check for bad phone numbers
    if (!$alertMessage && !preg_match('/^(\+\d{3} ?)?(\d{3} ?){3}$/', $phone)) {
        $alertMessage = 'Please use a valid phone number';
    }

    // if no errors at all: display success
    if (!$alertMessage) {
        $alertType = 'alert-success';
        $alertMessage = 'Yoohoo! You have successfully signed up!';
    }
}

?>
<?php require './components/header.php'; ?>
<main class="container">
    <h1 class="text-center">Form validation</h1>
    <div class="row justify-content-center">
        <form class="form-signup" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <?php if ($submittedForm): ?>
            <div class="alert <?php echo $alertType; ?>"><?php echo $alertMessage; ?></div>
            <?php endif; ?>
            <div class="form-group">
                <label>Name</label>
                <input class="form-control" name="name" value="<?php echo isset($_POST['name']) ? $name : '' ?>">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input class="form-control" name="email" value="<?php echo isset($_POST['email']) ? $email : '' ?>">
            </div>
            <div class="form-group">
                <label>Phone</label>
                <input class="form-control" name="phone" value="<?php echo isset($_POST['phone']) ? $phone : '' ?>">
            </div>
            <button class="btn btn-primary" type="submit">Submit</button>
        </form>
    </div>
</main>
<?php require './components/footer.php'; ?>