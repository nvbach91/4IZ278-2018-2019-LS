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
$avatar = $user['avatar'];
$district = $user['district'];


$stmt = $db->prepare('SELECT * FROM music_genres join listens_to WHERE
 music_genres.music_genre_id = listens_to.music_genres_music_genre_id AND listens_to.users_user_id= ?');
$stmt->execute([$user_id]);
$music_genres = $stmt->fetchAll();


$stmt = $db->prepare('SELECT * FROM instruments join person_instrument WHERE
 instruments.instrument_id = person_instrument.instruments_instrument_id AND person_instrument.users_user_id= ?');
$stmt->execute([$user_id]);
$instruments = $stmt->fetchAll();

$stmt = $db->prepare('SELECT * FROM instruments join person_instrument WHERE
 instruments.instrument_id = person_instrument.instruments_instrument_id AND person_instrument.users_user_id= ?');
$stmt->execute([$user_id]);
$instruments = $stmt->fetchAll();

$stmt = $db->prepare('SELECT * FROM bands join band_members WHERE
bands.band_id = band_members.bands_band_id and band_members.users_user_id = ?');
$stmt->execute([$user_id]);
$bands_member = $stmt->fetchAll();
?>

<?php require __DIR__ . '/incl/header.php' ?>
<div class="container">

    <div class="card border-dark" style="width: 50%;">
        <img src="./images/<?php echo isset($avatar) ? $avatar : $DEFAULT_AVATAR ?>" style="width:100%">
        <h2 class="card-title"><?php echo $first_name . ' ' . $last_name; ?></h2>
        <p class="card-text">Telefon: <?php echo $phone; ?></p>
        <p class="card-text">Kraj: <?php echo $district; ?></p>

        <ul class="list-group list-group-flush">
            <li class="list-group-item">
                <h6 class="card-subtitle mb-2 text-muted">Hudební žánry</h6>
                <?php foreach ($music_genres as $music_genre) {
                    if (!next($music_genres)) {
                        echo $music_genre['music_genre_name'];
                    } else {
                        echo $music_genre['music_genre_name'] . ', ';
                    }
                } ?>
            </li>
            <li class="list-group-item">
                <h6 class="card-subtitle mb-2 text-muted">Hudební nástroje</h6>
                <?php foreach ($instruments as $instrument) {
                    if (!next($instruments)) {
                        echo $instrument['instrument_name'];
                    } else {
                        echo $instrument['instrument_name'] . ', ';
                    }
                } ?>
            </li>


            <li class="list-group-item">
                <h6 class="card-subtitle mb-2 text-muted">Hraje v kapelách:</h6>

                <?php foreach ($bands_member as $band_member): ?>
                    <a href="band_profile.php?band_id=<?php echo $band_member['band_id'] ?>"><?php echo $band_member['band_name'] ?></a>
                <?php endforeach; ?>
            </li>
        </ul>


        <?php
        if (isset($_SESSION['band_id'])):
            if (is_in_array($bands_member, 'band_id', $_SESSION['band_id'])):
                ?>
                <button class="btn btn-lg btn-dark btn-block" disabled="disabled">Tento uživatel již je členem
                    tvé
                    kapely
                </button>
            <?php else: ?>
                <button class="btn btn-lg btn-dark btn-block">Přidat uživatele do kapely</button>
            <?php endif; ?>
        <?php endif; ?>
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

