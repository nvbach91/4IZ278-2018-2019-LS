<?php
require 'db.php';
require 'logged_in_required.php';

$submittedForm = $_SERVER['REQUEST_METHOD'] == 'POST';
if ($submittedForm) {

    $band_name = test_input($_POST['band_name']);
    $district = test_input($_POST['district']);
    $date_started = $_POST['date_started'];
    $all_ids = array();

    // vyberu kapely podle hudebniho zanru
    if (isset($_POST['music_genres'])) {
        $music_genres = $_POST['music_genres'];
        $numItems = count($music_genres);
        $i = 0;
        $values = '';
        foreach ($music_genres as $music_genre_id) {
            if (++$i === $numItems) {
                $values .= $music_genre_id;
            } else {
                $values .= $music_genre_id . ',';
            }
        }
        $stmt = $db->prepare("select
      distinct(bands_genres.bands_band_id)
      from bands_genres join music_genres
      where bands_genres.music_genres_music_genre_id = music_genres.music_genre_id
      and bands_genres.music_genres_music_genre_id in (" . $values . ")");
        $stmt->execute();
        $band_ids = $stmt->fetchAll();

        // ulozim id vybranych kapel
        foreach ($band_ids as $band_id) {
            array_push($all_ids, $band_id['bands_band_id']);
        }
    }

    // vyberu kapely podle jmena, data nebo kraje
    $stmt = $db->prepare("SELECT band_id FROM bands WHERE band_name like :band_name OR district = :district OR date_started > :date_started");
    $stmt->execute([
        'band_name' => '%'.$band_name.'%',
        'date_started' => $date_started,
        'district' => $district
    ]);
    $band_ids = $stmt->fetchAll();

    // $all_ids - id vsech vybranych kapel
    foreach ($band_ids as $band_id) {
        array_push($all_ids, $band_id['band_id']);
    }

    // neopakovat id v poli
    $all_ids = array_unique($all_ids);


    $numItems = count($all_ids);
    $i = 0;
    $values = '';
    foreach ($all_ids as $all_id) {
        if (++$i === $numItems) {
            $values .= $all_id;
        } else {
            $values .= $all_id . ',';
        }
    }
    // selectnu vsechny kapely pro zobrazeni
    $stmt = $db->prepare("SELECT * FROM bands WHERE band_id in (" . $values . ')');
    $stmt->execute();
    $bands = $stmt->fetchAll();
}

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
                    <label for="username">Jméno kapely</label>
                    <div class="input-group">

                        <input name="band_name" type="text" class="form-control" placeholder="Jméno kapely"
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
                <div class="form-group"> <!-- Date input -->
                    <label class="control-label" for="date">Datum vzniku kapely</label>
                    <input class="form-control" name="date_started" placeholder="YYYY-MM-DD" type="text"
                           value="<?php echo @$date_started; ?>" autocomplete="off" />
                </div>
                <div class="mb-3">
                    <label for="music_genres">Hudební styly (podrž ctrl pro označení více)</label>
                    <select name="music_genres[]" class="form-control" multiple="multiple">
                        <?php foreach ($music_genres as $music_genre): ?>
                            <option value="<?php echo $music_genre['music_genre_id']; ?>"><?php echo $music_genre['music_genre_name']; ?></option>
                        <?php endforeach; ?>
                    </select>

                </div>
                <button class="btn btn-lg btn-dark btn-block text-uppercase" type="submit">Vyhledat kapely</button>
            </form>

        </div>

        <div class="col-8">
            <?php if (isset($bands)): ?>
                <?php foreach ($bands as $band): ?>

                    <div class="card" style="width: 50%; float: left">
                        <img src="./images/<?php echo isset($band['avatar']) ? $band['avatar'] : $DEFAULT_AVATAR  ?>"
                              style="width:100%">
                        <a href="band_profile.php?band_id=<?php echo $band['band_id']?>"><h3><?php echo $band['band_name']; ?></h3></a>
                        <p class="title">Datum vzniku: <?php echo $band['date_started']; ?></p>
                        <p><?php echo $band['district']; ?></p>
                        <p><b><u>Hudební žánry</u></b></p>
                        <?php // foreach ($music_genres as $music_genre): ?>
                        <p><?php //echo $music_genre['music_genre_name'] ?></p>

                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<div style="margin-bottom: 150px"></div>


<?php require __DIR__ . '/incl/footer.php' ?>

