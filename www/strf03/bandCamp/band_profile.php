<?php
require 'db.php';

require 'logged_in_required.php';
$owner = false;

if (isset($_SESSION['band_id'])) {
    $owner = $_GET['band_id'] == $_SESSION['band_id'];
}
$band_id = $_GET['band_id'];

$stmt = $db->prepare('SELECT * FROM bands WHERE band_id = ?');
$stmt->execute([$band_id]);
$band = $stmt->fetch();

if (empty($band)) {
    redirect();
}

$band_name = $band['band_name'];
$date_started = $band['date_started'];
$district = $band['district'];


$stmt = $db->prepare('SELECT * FROM articles WHERE bands_band_id =?'); // TODO offset ?? cv08
$stmt->execute([$band_id]);
$articles = $stmt->fetchAll();


$stmt = $db->prepare('SELECT * FROM music_genres join bands_genres WHERE
 music_genres.music_genre_id = bands_genres.music_genres_music_genre_id AND bands_genres.bands_band_id = ?');
$stmt->execute([$band_id]);
$music_genres = $stmt->fetchAll();

$stmt = $db->prepare('SELECT * FROM users join band_members WHERE
users.user_id = band_members.users_user_id and band_members.bands_band_id = ?');
$stmt->execute([$band_id]);
$members_of_band = $stmt->fetchAll();

?>

<?php require __DIR__ . '/incl/header.php' ?>
<main class="container">
    <br>
    <div class="row">
        <div class="col-4">
            <div class="card border-dark">
                <img src="./images/<?php echo isset($band['avatar']) ? $band['avatar'] : $DEFAULT_AVATAR ?>"
                     alt="Profile image" style="width:100%">

                <h2 class="card-title"><?php echo $band_name; ?></h2>
                <p class="card-text">Datum vzniku: <?php echo $date_started; ?>

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
                        <h6 class="card-subtitle mb-2 text-muted">Členové kapely</h6>
                        <?php foreach ($members_of_band as $member_of_band): ?>
                            <a href="user_profile.php?user_id=<?php echo $member_of_band['user_id']; ?>"><?php echo $member_of_band['first_name'] . ' ' . $member_of_band['last_name'] ?></a>
                        <?php endforeach; ?>
                    </li>
                </ul>

                <?php if ($owner): ?>

                    <a href="band_change_profile.php" class="btn btn-lg btn-dark btn-block">Upravit profil</a>

                <?php endif; ?>
            </div>
        </div>

        <div class="col-8">
            <?php if ($owner): ?>
                <a href="new_article.php" class="btn btn-lg btn-dark btn-block">Nový článek</a>
                <br><br>
            <?php endif; ?>

            <?php if (empty($articles) && !$owner): ?>
                <h5 class="card-subtitle mb-2 text-muted text-center">Kapela ještě nepřidala žádné články</h5>
            <?php endif; ?>

            <?php foreach ($articles as $article): ?>
                <h2>
                    <?php if ($owner): ?>
                    <a href="article_edit.php?article_id=<?php echo $article['article_id'] ?>"> <?php endif; ?>
                        <?php echo $article['header'] ?><?php if ($owner): ?> </a> <?php endif; ?></h2>
                <p><?php echo $article['content'] ?></p>

                    <div class="container">
                        <h4>Komentáře</h4>

                            <?php
                            $stmt = $db->prepare('select * from comments join users 
where comments.users_user_id=users.user_id and comments.articles_article_id = ?');
                            $stmt->execute([$article['article_id']]);
                            $comments = $stmt->fetchAll();

                            foreach ($comments as $comment): ?>
                                <div class="card">
                                <?php echo $comment['first_name'].' '. $comment['text']; ?>
                                </div>
                            <?php endforeach; ?>


                        <br>
                        <?php if (isset($_SESSION['user_id'])): ?>
                        <form class="form-inline" method="post" action="add_comment.php?article_id=<?php echo $article['article_id']; ?>&band_id=<?php echo $article['bands_band_id']; ?>">
                            <div class="form-group">
                                <input class="form-control" name="text"  type="text" placeholder="Your comments" />
                            </div>
                            <div class="form-group">
                                <button class="btn btn-large">Add</button>
                            </div>
                        </form>
                        <?php endif; ?>
                    <br><br>

            <?php endforeach; ?>
        </div>

    </div>
</main>
<div style="margin-bottom: 150px"></div>
<?php require __DIR__ . '/incl/footer.php' ?>



