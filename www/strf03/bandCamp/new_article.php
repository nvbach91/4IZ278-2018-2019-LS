<?php
require 'db.php';
require 'logged_in_required.php';

require 'band_required.php';
$band_id = $_SESSION['band_id'];

$submittedForm = $_SERVER['REQUEST_METHOD'] == 'POST';
if ($submittedForm) {
    $header = test_input($_POST['header']);
    $content = test_input($_POST['content']);

    if(empty($header)){
        $errors['name'] = 'Vyplň nadpis článku';
    }

    if(empty($content)){
        $errors['content'] = 'Článek nemůže být prázdný';
    }

    if (empty($errors)) {


        $stmt = $db->prepare('Insert Into articles(header, content, bands_band_id) Values (:header, :content, :bands_band_id)');

        $stmt->execute([
            'header' => $header,
            'content' => $content,
            'bands_band_id' => $band_id,

        ]);

        header('Location: band_profile.php?band_id='.$_SESSION['band_id']);
    }
}

?>

<?php require __DIR__ . '/incl/header.php' ?>
<div class="container">
    <h1>Napiš nový článek</h1>

    <form method="POST">
        <?php if ($submittedForm && !empty($errors)): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php echo implode('<br>', array_values($errors)); ?>
            </div>
        <?php endif; ?>
        <div class="form-label-group">
            <label for="header">Nadpis</label>
            <input class="form-control" name="header" type="text" value="<?php echo @$header ?>">
        </div>
        <div class="form-label-group">
            <label for="content">Obsah článku</label>
            <textarea class="form-control" name="content"><?php echo @$content ?></textarea>
        </div>
        <br>
        <button class="btn btn-lg btn-dark btn-block" type="submit">Přidat článek</button>


    </form>
</div>
<div style="margin-bottom: 300px"></div>
<?php require __DIR__ . '/incl/footer.php' ?>

