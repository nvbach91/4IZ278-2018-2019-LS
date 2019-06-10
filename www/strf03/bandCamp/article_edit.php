<?php
require 'db.php';
require 'logged_in_required.php';
require 'band_required.php';

$band_id = $_SESSION['band_id'];
$article_id = $_GET['article_id'];

$stmt = $db->prepare("SELECT * FROM articles WHERE article_id = ? LIMIT 1");
$stmt->execute([$article_id]);
$article = $stmt->fetch();

// podminka, zda se jedna o muj clanek
if ($article['bands_band_id'] != $band_id) {
    header('Location: band_profile.php?band_id=' . $_SESSION['band_id']);
}

$submittedForm = $_SERVER['REQUEST_METHOD'] == 'POST';

if ($submittedForm) {
    $header = test_input($_POST['header']);
    $content = test_input($_POST['content']);
    $article_id = $_POST['article_id'];
    if (empty($header)) {
        $errors['header'] = 'Vyplň nadpis článku';
    }

    if (empty($content)) {
        $errors['content'] = 'Článek nemůže být prázdný';
    }

    if (empty($errors)) {


        $stmt = $db->prepare('UPDATE articles SET header = :header, content = :content WHERE article_id = :article_id');

        $stmt->execute([
            'header' => $header,
            'content' => $content,
            'article_id' => $article_id
        ]);

        header('Location: band_profile.php?band_id=' . $_SESSION['band_id']);
    }
}

$stmt = $db->prepare('SELECT * FROM articles WHERE article_id = :article_id');
$stmt->execute([
    'article_id' => $article_id
]);
$article = $stmt->fetch();

?>

<?php require __DIR__ . '/incl/header.php' ?>

<div class="container">
    <h1>Uprav článek</h1>

    <form method="POST">
        <?php if ($submittedForm && !empty($errors)): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php echo implode('<br>', array_values($errors)); ?>
            </div>
        <?php endif; ?>
        <div class="form-label-group">
            <label for="header">Nadpis</label>
            <input class="form-control" name="header" type="text" value="<?php echo $article['header']; ?>">
        </div>
        <div class="form-label-group">
            <label for="content">Obsah článku</label>
            <textarea class="form-control" name="content" rows="7"><?php echo $article['content']; ?></textarea>
        </div>
        <input type="hidden" name="article_id" value="<?php echo $article['article_id']; ?>">
        <br>
        <button class="btn btn-lg btn-dark btn-block" type="submit">Upravit</button>
    </form>
    <br>
    <form action="article_delete.php?article_id=<?php echo $article['article_id']; ?>" method="POST">
        <button class="btn btn-lg btn-dark btn-block" type="submit">Vymazat</button>
    </form>
</div>
<div style="margin-bottom: 100px"></div>
<?php require __DIR__ . '/incl/footer.php' ?>



