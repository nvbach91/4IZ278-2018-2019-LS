<?php
require 'db.php';

require 'logged_in_required.php';
$owner = false;
if (isset($_SESSION['user_id'])) {
    $owner = $_GET['user_id'] == $_SESSION['user_id'];
}
$user_id = $_GET['user_id'];

$stmt = $db->prepare('SELECT * FROM users WHERE user_id = ?');
$stmt->execute([$user_id]);
$user = $stmt->fetch();

if (empty($user) || !isset($user)) {
    redirect();
}

$first_name = $user['first_name'];
$last_name = $user['last_name'];
$phone = $user['phone'];
$district = $user['district'];


$stmt = $db->prepare('SELECT * FROM music_genres join listens_to WHERE
 music_genres.music_genre_id = listens_to.music_genres_music_genre_id AND listens_to.users_user_id= ?');
$stmt->execute([$user_id]);
$music_genres = $stmt->fetchAll();


$stmt = $db->prepare('SELECT * FROM instruments join person_instrument WHERE
 instruments.instrument_id = person_instrument.instruments_instrument_id AND person_instrument.users_user_id= ?');
$stmt->execute([$user_id]);
$instruments = $stmt->fetchAll();

?>

<?php require __DIR__ . '/incl/header.php' ?>
<div class="container">

    <div class="card" style="width: 50%;">
        <img src="./images/<?php echo isset($_SESSION['avatar']) ? $_SESSION['avatar'] : $DEFAULT_AVATAR ?>"
             style="width:100%">
        <h1><?php echo $first_name; ?></h1>
        <p><?php echo $phone; ?></p>
        <p><?php echo $district; ?></p>
        <p><b><u>Co rád posloucháš:</u></b></p>
        <?php foreach ($music_genres as $music_genre): ?>
            <p><?php echo $music_genre['music_genre_name'] ?></p>
        <?php endforeach; ?>
        <p><b><u>Na co hraješ:</u></b></p>
        <?php foreach ($instruments as $instrument): ?>
            <p><?php echo $instrument['instrument_name'] ?></p>
        <?php endforeach; ?>
        <?php if ($owner): ?>

                <a href="user_change_profile.php?id=<?php echo $user_id ?>"
                   class="btn btn-lg btn-dark btn-block text-uppercase">Změnit profil
                </a>

        <?php endif; ?>
    </div>
</div>
</div>
<div style="margin-bottom: 50px"></div>

<?php require __DIR__ . '/incl/footer.php' ?>

