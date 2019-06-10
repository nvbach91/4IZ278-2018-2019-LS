<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="strf03">
    <title>BandCamp</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link rel="stylesheet" href="./css/style.css"/>


</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-secondary fixed-top">
    <div class="container">
        <img class="logo" src="./images/site/band_camp.png" alt="logo">
        <a class="navbar-brand" href="index.php">BandCamp</a>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">

                <?php if (isset($_SESSION['band_id'])): ?>
                    <li class="nav-item<?php echo strpos($_SERVER['REQUEST_URI'], 'band_profile') ? ' active' : '' ?>">
                        <a class="nav-link" href="band_profile.php?band_id=<?php echo $_SESSION['band_id']; ?>">Home</a>
                    </li>
                    <li class="nav-item<?php echo strpos($_SERVER['REQUEST_URI'], 'band_search') ? ' active' : '' ?>">
                        <a class="nav-link" href="band_search.php">Vyhledej kapelu</a>
                    </li>
                    <li class="nav-item<?php echo strpos($_SERVER['REQUEST_URI'], 'band_change_profile') ? ' active' : '' ?>">
                        <a class="nav-link" href="band_change_profile.php?band_id=<?php echo $_SESSION['band_id']; ?>"><i
                                    class="fas fa-user"></i> <?php echo $_SESSION['email']; ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="signout.php"><i class="fas fa-sign-out-alt"></i></a>
                    </li>

                <?php elseif(isset($_SESSION['user_id'])): ?>
                    <li class="nav-item<?php echo strpos($_SERVER['REQUEST_URI'], 'user_profile') ? ' active' : '' ?>">
                        <a class="nav-link" href="user_profile.php?user_id=<?php echo $_SESSION['user_id']; ?>">Home</a>
                    </li>
                    <li class="nav-item<?php echo strpos($_SERVER['REQUEST_URI'], 'band_search') ? ' active' : '' ?>">
                        <a class="nav-link" href="band_search.php">Vyhledej kapelu</a>
                    </li>
                    <li class="nav-item<?php echo strpos($_SERVER['REQUEST_URI'], 'user_change_profile') ? ' active' : '' ?>">
                        <a class="nav-link" href="user_change_profile.php?user_id=<?php echo $_SESSION['user_id']; ?>"><i
                                    class="fas fa-user"></i> <?php echo $_SESSION['email']; ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="signout.php"><i class="fas fa-sign-out-alt"></i></a>
                    </li>

                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo strpos($_SERVER['REQUEST_URI'], 'registration') ? ' index.php' : 'registration.php' ?>">
                            <?php echo strpos($_SERVER['REQUEST_URI'], 'registration') ? 'Přihlášení' : 'Registrace' ?></a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>