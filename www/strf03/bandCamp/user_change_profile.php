<?php
require 'db.php';

require 'logged_in_required.php';

require 'user_required.php';

$submittedForm = $_SERVER['REQUEST_METHOD'] == 'POST';
if ($submittedForm) {
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

    if (!preg_match('/^(\+420)? ?[1-9][0-9]{2} ?[0-9]{3} ?[0-9]{3}$/', $phone)) {
        $errors['phone'] = 'Vyplň validní telefonní číslo';

    }
    if (empty($first_name)) {
        $errors['first_name'] = 'Vyplň jméno';
    }
    if (empty($last_name)) {
        $errors['last_name'] = 'Vyplň příjmení';
    }

    if (!in_array($district, $districts)) {
        $errors['district'] = 'Vyber kraj ze kterého pocházíš';
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

        $stmt = $db->prepare('UPDATE users SET first_name= :first_name, last_name =:last_name, phone=:phone, district= :district WHERE user_id = :user_id');
        $stmt->execute([
            'first_name' => $first_name,
            'last_name' => $last_name,
            'phone' => $phone,
            'district' => $district,
            'user_id' => $_SESSION['user_id']
        ]);

        $stmt = $db->prepare('DELETE FROM listens_to WHERE users_user_id=?');
        $stmt->execute([$_SESSION['user_id']]);


        $stmt = $db->prepare('DELETE FROM person_instrument WHERE users_user_id=?');
        $stmt->execute([$_SESSION['user_id']]);


        if (!empty($music_genres)) {
            $values = array();

            foreach ($music_genres as $music_genre) {
                $values[] = '(' . $music_genre . ', ' . $_SESSION['user_id'] . ')'; // TODO ošetřit vstup
            }

            $stmt = $db->prepare('INSERT INTO listens_to (music_genres_music_genre_id, users_user_id) VALUES ' . implode(',', $values));
            $stmt->execute();
        }

        if (!empty($instruments)) {
            $values = array();

            foreach ($instruments as $instrument) {
                $values[] = '(' . $instrument . ', ' . $_SESSION['user_id'] . ')'; // TODO ošetřit vstup
            }

            $stmt = $db->prepare('INSERT INTO person_instrument (instruments_instrument_id, users_user_id) VALUES ' . implode(',', $values));
            $stmt->execute();
        }

        header('Location: user_profile.php?user_id='.$_SESSION['user_id']);
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
        <h5 class="text-center">Úprava profilu</h5>
        <form method="POST">
        <div class="card" style="width: 50%">


            <?php if ($submittedForm && !empty($errors)): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?php echo implode('<br>', array_values($errors)); ?>
                </div>
            <?php endif; ?>
            <img src="./images/<?php echo isset($current_user['avatar']) ? $current_user['avatar'] : 'no_profile.jpg'?>"
                 alt="John" style="width:100%" height="300px">
            <br>

                <div class="mb-3">
                    <label for="name">Jméno</label>

                    <div class="input-group">

                        <input name="first_name" type="text" class="form-control" placeholder="Jméno"
                               value="<?php echo $current_user['first_name']; ?>">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="last_name">Příjmení</label>

                    <div class="input-group">

                        <input name="last_name" type="text" class="form-control" placeholder="Příjmení"
                               value="<?php echo $current_user['last_name']; ?>">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="phone">Telefonní číslo</label>

                    <div class="input-group">

                        <input name="phone" type="tel" pattern="^(\+420)? ?[1-9][0-9]{2} ?[0-9]{3} ?[0-9]{3}$"
                               class="form-control"
                               placeholder="Telefonní číslo" value="<?php echo $current_user['phone']; ?>">
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
                    <select name="district" class="custom-select d-block w-100">
                        <option value="">Vyber kraj...</option>
                        <?php foreach ($districts as $name): ?>
                            <option value="<?php echo $name ?>" <?php echo $name == $current_user['district'] ? 'selected' : '' // todo dát všude?> > <?php echo $name ?> </option>
                        <?php endforeach; ?>
                    </select>
                </div>



                <button class="btn btn-lg btn-dark btn-block text-uppercase" type="submit">Upravit profil</button>
            </form>

        </div>
    </main>
    <div style="margin-bottom: 50px"></div>


<?php require __DIR__ . '/incl/footer.php' ?>