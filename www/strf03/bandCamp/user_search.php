<?php
require 'db.php';
require 'logged_in_required.php';



$stmt = $db->prepare('SELECT * FROM users');
$stmt->execute();
$users = $stmt->fetchAll();

$stmt = $db->prepare('SELECT * FROM music_genres');
$stmt->execute();
$music_genres = $stmt->fetchAll();
?>

<?php require __DIR__ . '/incl/header.php' ?>
<div class="container">
    <div class="row">
        <div class="col-4">
            <form method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="username">Jméno hudebníka</label>
                    <div class="input-group">

                        <input name="band_name" type="text" class="form-control" placeholder="Jméno hudebníka"
                               value="<?php echo @$band_name; ?>">
                    </div>
                </div>

                <div class="mb-3">
                    Kraj: <select name="district" class="custom-select d-block w-100" id="state">
                        <option value="">Vyber kraj...</option>
                        <?php foreach ($districts as $name): ?>
                            <option value="<?php echo $name ?>"> <?php echo $name ?> </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="music_genres">Hudební styly (podrž ctrl pro označení více)</label>
                    <select name="music_genres[]" class="form-control" multiple="multiple">
                        <?php foreach ($music_genres as $music_genre): ?>
                            <option value="<?php echo $music_genre['music_genre_id']; ?>"><?php echo $music_genre['music_genre_name']; ?></option>
                        <?php endforeach; ?>
                    </select>

                </div>
                <button class="btn btn-lg btn-dark btn-block text-uppercase" type="submit" disabled>Not working yet</button>
            </form>

        </div>

        <div class="col-8">
            <?php if (isset($users)): ?>
                <?php foreach ($users as $user): ?>
                    <a href="user_profile.php?user_id=<?php echo $user['user_id'] ?>">
                        <div class="card" style="width: 50%; float: left">
                            <img src="./images/<?php echo isset($user['avatar']) ? $user['avatar'] : $DEFAULT_AVATAR ?>"
                                 style="width:100%; height: 300px">
                            <h3><?php echo $user['first_name'].' '.$user['last_name']; ?></h3>
                            <p>Kraj: <?php echo $user['district']; ?></p>
                            <p>Telefon: <?php echo $user['phone']; ?></p>

                        </div>
                    </a>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<div style="margin-bottom: 200px"></div>


<?php require __DIR__ . '/incl/footer.php' ?>

