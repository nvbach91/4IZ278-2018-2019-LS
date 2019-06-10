<?php
session_start();
require 'db.php';

$submittedForm = $_SERVER['REQUEST_METHOD'] == 'POST';
if ($submittedForm) {
    $email = test_input($_POST['email']);
    $first_name = test_input($_POST['first_name']);
    $last_name = test_input($_POST['last_name']);

    $phone = test_input($_POST['phone']);

    $avatar; // TODO avatar

    if (isset($_POST['music_genres'])) {
        $music_genres = $_POST['music_genres'];
    }
    if (isset($_POST['instruments'])) {
        $instruments = $_POST['instruments'];
    }

    $district = $_POST['district'];

    $password = test_input($_POST['password']);
    $password_again = test_input($_POST['password_again']);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Zadej validní email';
    }
    if (!preg_match('/^(\+\d{3} ?)?(\d{3} ?){3}$/', $phone)) {
            $errors['phone'] = 'Vyplň validní telefonní číslo';

    }
    if (empty($first_name)) {
        $errors['first_name'] = 'Vyplň jméno';
    }
    if (empty($last_name)) {
        $errors['last_name'] = 'Vyplň příjmení';
    }

    if (strlen($password) < 7 || $password!=$password_again) {
        $errors['password'] = 'Použij více než 7 znaků pro heslo. Hesla se musí shodovat';
    }
    if (!in_array($district, $districts)) {
        $errors['district'] = 'Vyber kraj ze kterého pocházíš';
    }

    $select = $db->prepare("SELECT * FROM users WHERE email = ? LIMIT 1");
    $select->execute([$email]);
    $existing_user = $select->fetch();

    $select = $db->prepare("SELECT * FROM bands WHERE email = ? LIMIT 1");
    $select->execute([$email]);
    $existing_band = $select->fetch();

    if (!empty($existing_user)|| !empty($existing_band)) {
        $errors['existing'] = 'Uživatel s tím emailem už existuje';
    }

    $file_tmp = '';
    $file_name = '';
    $uploads_dir = "images";
    if (isset($_FILES['image'])) {
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_tmp = $_FILES['image']['tmp_name'];
        $file_type = $_FILES['image']['type'];
        $explode_var = explode('.', $file_name);
        $file_ext = strtolower(end($explode_var));

        $extensions = array("jpeg", "jpg", "png");

        if (in_array($file_ext, $extensions) === false) {
            $errors['extensions'] = "extension not allowed, please choose a JPEG or PNG file.";
        }

        if ($file_size > 2097152) {
            $errors['size'] = 'File size must be excately 2 MB';
        }

        $increment = 0;
        $name = pathinfo($_FILES['image']['name'], PATHINFO_FILENAME);
        while (is_file($uploads_dir . '/' . $file_name)) {
            $increment++;
            $file_name = $name . $increment . '.' . $file_ext;
        }

    }

    if (empty($errors)) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $db->prepare('Insert Into users(email, first_name, last_name, phone, avatar, district, password)
          Values (:email, :name, :last_name,:phone, null, :district, :password)');

        $stmt->execute([
            'email' => $email,
            'name' => $first_name,
            'last_name' => $last_name,
            'phone' => $phone,
            'district' => $district,
            'password' => $hashedPassword
        ]);


        // Načtu ID právě vloženého uživatele pro vložení do listens_to
        $stmt = $db->prepare('SELECT user_id FROM users WHERE email = :email LIMIT 1');
        $stmt->execute([
            'email' => $email
        ]);
        $user_id = (int)$stmt->fetchColumn();
        echo $user_id;
        if (!empty($music_genres)) {
            $values = array();

            foreach ($music_genres as $music_genre) {
                $values[] = '(' . $music_genre . ', ' . $user_id . ')'; // TODO ošetřit vstup
            }

            $stmt = $db->prepare('INSERT INTO listens_to (music_genres_music_genre_id, users_user_id) VALUES ' . implode(',', $values));
            $stmt->execute();
        }

        if (!empty($instruments)) {
            $values = array();

            foreach ($instruments as $instrument) {
                $values[] = '(' . $instrument . ', ' . $user_id . ')'; // TODO ošetřit vstup
            }

            $stmt = $db->prepare('INSERT INTO person_instrument (instruments_instrument_id, users_user_id) VALUES ' . implode(',', $values));
            $stmt->execute();
        }

        header('Location: index.php');
    }
}

$stmt = $db->prepare('SELECT * FROM music_genres');
$stmt->execute();
$music_genres = $stmt->fetchAll();

$stmt = $db->prepare('SELECT * FROM instruments');
$stmt->execute();
$instruments = $stmt->fetchAll();
?>
<?php require __DIR__ . '/incl/header.php' ?>

    <main class="container">
        <div class="col-md-8 order-md-1">
            <h4 class="mb-3">Registrace uživatele</h4>
            <?php if ($submittedForm && !empty($errors)): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?php echo implode('<br>', array_values($errors)); ?>
                </div>
            <?php endif; ?>
            <form method="POST">

                <div class="mb-3">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" placeholder="you@example.com" value="<?php echo @$email ?>">
                </div>

                <div class="mb-3">
                    <label for="name">Jméno</label>

                    <div class="input-group">

                        <input name="first_name" type="text" class="form-control" placeholder="Jméno" value="<?php echo @$first_name ?>">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="last_name" >Příjmení</label>

                    <div class="input-group">

                        <input name="last_name" type="text" class="form-control" placeholder="Příjmení" value="<?php echo @$last_name ?>">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="phone">Telefonní číslo</label>

                    <div class="input-group">

                        <input name="phone" type="tel" pattern="^(\+420)? ?[1-9][0-9]{2} ?[0-9]{3} ?[0-9]{3}$}" class="form-control"
                               placeholder="Telefonní číslo" value="<?php echo @$phone ?>">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="music_genres">Co máš rád? (Podrž ctrl pro označení více)</label>
                    <select name="music_genres[]" class="form-control" multiple="multiple">
                        <?php foreach ($music_genres as $music_genre): ?>
                            <option value="<?php echo $music_genre['music_genre_id']; ?>"><?php echo $music_genre['music_genre_name']; ?></option>
                        <?php endforeach; ?>
                    </select>

                </div>

                <div class="mb-3">
                    <label for="instruments">Na co hraješ? (Podrž ctrl pro označení více)</label>
                    <select name="instruments[]" class="form-control" multiple="multiple">
                        <?php foreach ($instruments as $instrument): ?>
                            <option value="<?php echo $instrument['instrument_id']; ?>"><?php echo $instrument['instrument_name']; ?></option>
                        <?php endforeach; ?>
                    </select>

                </div>

                <div class="mb-3">
                    <label for="district">Kraj</label>
                    <select name="district" class="custom-select d-block w-100" value="<?php echo @$district  //todo funguje takhle? ?>">
                        <option value="">Vyber kraj...</option>
                        <?php foreach ($districts as $name): ?>
                            <option value="<?php echo $name ?>"> <?php echo $name ?> </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="email">Heslo</label>
                    <input name="password" type="password" class="form-control" placeholder="Heslo">
                </div>
                <div class="mb-3">
                    <label for="email">Heslo znovu</label>
                    <input name="password_again" type="password" class="form-control"
                           placeholder="Heslo znovu">
                </div>

                <button class="btn btn-lg btn-dark btn-block text-uppercase" type="submit">Vytvořit profil</button>

    </main>
    <br><br>


<?php require __DIR__ . '/incl/footer.php' ?>