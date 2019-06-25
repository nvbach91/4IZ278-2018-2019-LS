<?php
session_start();
require 'db.php';


$submittedForm = $_SERVER['REQUEST_METHOD'] == 'POST';
if ($submittedForm) {
    $band_name = test_input($_POST['band_name']);
    $email = test_input($_POST['email']);
    $date_started = test_input($_POST['date_started']);
    if (isset($_POST['music_genres'])) {
        $music_genres = $_POST['music_genres']; // todo test input foreach ??
    }
    $district = test_input($_POST['district']);
    $password = test_input($_POST['password']);
    $password_again = test_input($_POST['password_again']);

    if (empty($band_name)) {
        $errors['band_name'] = 'Zadejte jméno kapely';
    }
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Zadejte platný email';
    }

    if (!empty($date_started)) {
        $date_exploded = explode('-', $date_started);
        if (!checkdate($date_exploded[1], $date_exploded[2], $date_exploded[0])) {
            $errors['date_started'] = 'Prosím zvolte platné datum';
        }
    } else {
        $errors['date_started'] = 'Prosím zvolte platné datum';  // todo algoritmus
    }

    if (strlen($password) < 7 || $password != $password_again) {
        $errors['password'] = 'Heslo musí být delší než 7 znaků a hesla se musí shodovat';
    }
    if (!in_array($district, $districts)) {
        $errors['district'] = 'Prosím zvolte platný kraj';
    }

    $select = $db->prepare("SELECT * FROM bands WHERE email = ? LIMIT 1");
    $select->execute(array($email));
    $existingBandId = $select->fetch();


    $select = $db->prepare("SELECT * FROM users WHERE email = ? LIMIT 1");
    $select->execute(array($email));
    $existingUser = $select->fetch();


    if ($existingBandId || $existingUser) {
        $errors['existing'] = 'Tento email je již registrován!';
    }

    $file_tmp;
    $file_name;
    $uploads_dir = "images";
    if (file_exists($_FILES['image']['tmp_name']) || is_uploaded_file($_FILES['image']['tmp_name'])) {
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_tmp = $_FILES['image']['tmp_name'];
        $file_type = $_FILES['image']['type'];
        $explode_var = explode('.', $file_name);
        $file_ext = strtolower(end($explode_var));

        $extensions = array("jpeg", "jpg", "png");

        if (in_array($file_ext, $extensions) === false) {
            $errors['extensions'] = "Zvolte obrázek s příponou .jpg nebo .png";
        }

        if ($file_size > 2097152) {
            $errors['size'] = 'Soubor musí být menší než 2MB'; // todo change
        }

        $increment = 0;
        $name = pathinfo($_FILES['image']['name'], PATHINFO_FILENAME);
        while (is_file($uploads_dir . '/' . $file_name)) {
            $increment++;
            $file_name = $name . $increment . '.' . $file_ext;
        }

    }


    if (empty($errors)) {

        move_uploaded_file($file_tmp, $uploads_dir . "/" . $file_name);


        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $db->prepare('Insert Into bands(band_name, email, likes, avatar, date_started, district, password) Values (:band_name, :email, 0, :avatar, :date_started, :district, :password)');

        $stmt->execute([
            'band_name' => $band_name,
            'email' => $email,
            'date_started' => $date_started,
            'district' => $district,
            'password' => $hashedPassword,
            'avatar' => $file_name
        ]);

        if (isset($music_genres)) {
            // Načtu ID právě vložené kapely pro vložení do bands_genres
            $stmt = $db->prepare('SELECT band_id FROM bands WHERE email = :email LIMIT 1');
            $stmt->execute([
                'email' => $email
            ]);
            $band_id = (int)$stmt->fetchColumn();


            $values = array();
            foreach ($music_genres as $music_genre_id) {
                $values[] = '(' . $music_genre_id . ', ' . $band_id . ')'; // TODO ošetřit vstup
                echo $music_genre_id;
            }

            $stmt = $db->prepare('INSERT INTO bands_genres (music_genres_music_genre_id, bands_band_id) VALUES ' . implode(',', $values));
            $stmt->execute();
        }

        header('Location: index.php?registration=success');
    }
}

$stmt = $db->prepare('SELECT * FROM music_genres');
$stmt->execute();
$music_genres = $stmt->fetchAll();


?>
<?php require __DIR__ . '/incl/header.php' ?>
<main class="container">
    <div class="col-md-8 order-md-1">
        <h4 class="mb-3">Zaregistrovat kapelu</h4>
        <?php if ($submittedForm && !empty($errors)): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php echo implode('<br>', array_values($errors)); ?>
            </div>
        <?php endif; ?>
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="band_name">Jméno kapely</label>

                <input name="band_name" type="text" class="form-control" placeholder="Jméno kapely"
                       value="<?php echo @$band_name; ?>">

            </div>

            <div class="mb-3">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" placeholder="Email"
                       value="<?php echo @$email; ?>">
            </div>
            <div class="mb-3">
                <label for="music_genres">Hudební styly (podrž ctrl pro označení více)</label>
                <select name="music_genres[]" class="form-control" multiple="multiple">
                    <?php foreach ($music_genres as $music_genre): ?>
                        <option value="<?php echo $music_genre['music_genre_id']; ?>"><?php echo $music_genre['music_genre_name']; ?></option>
                    <?php endforeach; ?>
                </select>

            </div>

            <div class="mb-3"> <!-- Date input -->
                <label class="control-label" for="date">Datum vzniku kapely</label>
                <input class="form-control" name="date_started" placeholder="YYYY-MM-DD" type="text"
                       value="<?php echo @$date_started; ?>" autocomplete="off"/>
            </div>


            <div class="mb-3">
                <label for="district">Kraj</label>
                <select name="district" class="custom-select d-block w-100">
                    <option value="">Vyber kraj...</option>
                    <?php foreach ($districts as $name): ?>
                        <option value="<?php echo $name ?>"> <?php echo $name ?> </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="password">Heslo</label>
                <input name="password" type="password" class="form-control" placeholder="Heslo">
            </div>

            <div class="mb-3">
                <label for="password_again">Heslo znovu</label>
                <input name="password_again" type="password" class="form-control"
                       placeholder="Heslo ještě jednou">
            </div>

            <div class="custom-file mb-3">
                <input type="file" class="custom-file-input" name="image" accept="image/x-png,image/gif,image/jpeg">
                <label class="custom-file-label" for="customFile">Vybrat profilový obrázek</label>
            </div>


            <button class="btn btn-lg btn-dark btn-block text-uppercase" type="submit">Vytvoř kapelu!</button>

</main>
<div style="margin-bottom: 50px"></div>

<?php require __DIR__ . '/incl/footer.php' ?>

<script>
    // Add the following code if you want the name of the file appear on select
    $(".custom-file-input").on("change", function () {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
</script>
