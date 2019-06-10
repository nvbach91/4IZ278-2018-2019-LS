<?php
require 'db.php';
require 'logged_in_required.php';

require 'band_required.php';

$submittedForm = $_SERVER['REQUEST_METHOD'] == 'POST';


if ($submittedForm) {
    $band_name = test_input($_POST['band_name']);
    $avatar; //TODO change avatar
    $dateStarted = test_input($_POST['date_started']);
    $district = test_input($_POST['district']);

    $password = test_input($_POST['password']);

    $password_again = test_input($_POST['password_again']);

    if (empty($band_name)) {
        $errors['band_name'] = 'Fill your name';
    }

    if (isset($_POST['music_genres'])) {
        $music_genres = $_POST['music_genres'];  // todo osetrit vstup??
    }


    if (!empty($dateStarted)) {
        $date_exploded = explode('-', $dateStarted);
        if (!checkdate($date_exploded[1], $date_exploded[2], (int)$date_exploded[0])) {
            $errors['date_started'] = 'Please enter valid date';
        }
    } else {
        $errors['date_started'] = 'Please enter valid date';  // todo algorithm
    }

    if (!in_array($district, $districts)) {
        $errors['district'] = 'Please select valid district';
    }

    if (empty($errors)) {
        $stmt = $db->prepare('UPDATE bands SET band_name = :band_name, date_started = :date, district= :district WHERE band_id = :id');
        $stmt->execute([
            'band_name' => $_POST['band_name'],
            'date' => $_POST['date_started'],
            'district' => $_POST['district'],
            'id' => $_SESSION['band_id']
        ]);

        $_SESSION['band_name'] = $_POST['band_name'];
        $_SESSION['date_started'] = $_POST['date_started'];
        $_SESSION['district'] = $_POST['district'];


        $stmt = $db->prepare('DELETE FROM bands_genres WHERE bands_band_id=?');

        $stmt->execute([$_SESSION['band_id']]);
        if (!empty($music_genres)) {
            $values = array();

            foreach ($music_genres as $music_genre) {
                $values[] = '(' . $music_genre . ', ' . $_SESSION['band_id'] . ')'; // TODO ošetřit vstup
            }

            $stmt = $db->prepare('INSERT INTO bands_genres (music_genres_music_genre_id, bands_band_id) VALUES ' . implode(',', $values));
            $stmt->execute();
        }

        header('Location: band_profile.php?band_id=' . $_SESSION['band_id']);
    }
}

$stmt = $db->prepare('SELECT * FROM music_genres');
$stmt->execute();
$music_genres = $stmt->fetchAll();

?>

<?php require __DIR__ . '/incl/header.php' ?>
<style>
    .card {
        max-width: 500px;
    }
</style>
<div class="container">

    <form method="POST">
        <h2>Úprava profilu</h2>
        <div class="card">
            <?php if ($submittedForm && !empty($errors)): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?php echo implode('<br>', array_values($errors)); ?>
                </div>
            <?php endif; ?>
            <img src="./images/<?php echo isset($current_band['avatar']) ? $current_band['avatar'] : $DEFAULT_AVATAR ?>"
                 alt="John" style="width:100%" height="300px">
            <br>
            <label for="band_name">Name:</label>
            <input type="text" name="band_name" class="form-control" value="<?php echo $current_band['band_name']; ?>"
                   placeholder="New name of your band" required="required">

            Hudební styly (podrž ctrl pro označení více)
            <select name="music_genres[]" class="form-control" multiple="multiple">
                <?php foreach ($music_genres as $music_genre): ?>
                    <option value="<?php echo $music_genre['music_genre_id']; ?>"><?php echo $music_genre['music_genre_name']; // todo selected ?></option>
                <?php endforeach; ?>
            </select>


            <div class="form-group"> <!-- Date input -->
                Date: <input name="date_started" class="form-control" placeholder="YYYY-MM-DD"
                             value="<?php echo $current_band['date_started']; ?>" type="text" required="required"/>
            </div>

            Kraj: <select value="<?php echo $current_band['district'] ?>" name="district"
                          class="custom-select d-block w-100" id="state" required="required">
                <option value="">Vyber kraj...</option>
                <?php foreach ($districts as $name): ?>
                    <option value="<?php echo $name ?>" <?php echo $current_band['district'] == $name ? 'selected=selected' : '' ?>> <?php echo $name ?> </option>
                <?php endforeach; ?>
            </select>


            <label for="password">Password:</label>
            <input type="password" name="password" class="form-control"
                   placeholder="Your new password" required="required">

            <label for="password_again">Password again:</label>
            <input type="password" name="password_again" class="form-control"
                   placeholder="New password again" required="required">
            <br>
            <button class="btn btn-lg btn-secondary btn-block text-uppercase" type="submit">Update account</button>
        </div>
</div>
</form>
<div style="margin-bottom: 50px"></div>

<?php require __DIR__ . '/incl/footer.php' ?>
