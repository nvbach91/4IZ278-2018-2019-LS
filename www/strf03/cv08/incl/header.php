<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Shop Homepage - Start Bootstrap Template</title>

    <!-- Bootstrap core CSS -->
    <link href="https://bootswatch.com/4/journal/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <!-- Custom styles for this template -->
    <link href="./styles/style.css" rel="stylesheet">

</head>

<body>

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="./index.php">Shop</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item<?php echo strpos($_SERVER['REQUEST_URI'], 'index') || preg_match('/\/$/', $_SERVER['REQUEST_URI']) ? ' active' : '' ?>">
                    <a class="nav-link" href="./index.php">Home
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li class="nav-item<?php echo strpos($_SERVER['REQUEST_URI'], 'cart') ? ' active' : '' ?>">
                        <a class="nav-link" href="./cart.php">Cart</a>
                    </li>
                    <?php if ($_SESSION['user_privilege'] > 2): ?>
                        <li class="nav-item<?php echo strpos($_SERVER['REQUEST_URI'], 'login') ? ' active' : '' ?>">
                            <a class="nav-link" href="./users.php">Users</a>
                        </li>
                    <?php endif; ?>
                    <li class="nav-item<?php echo strpos($_SERVER['REQUEST_URI'], 'profile') ? ' active' : '' ?>">
                        <a class="nav-link" href="./profile.php"><?php echo $_SESSION['user_email']; ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./signout.php"><i class="fas fa-sign-out-alt"></i></a>
                    </li>
                <?php else: ?>
                    <li class="nav-item<?php echo strpos($_SERVER['REQUEST_URI'], 'login') ? ' active' : '' ?>">
                        <a class="nav-link" href="./signin.php">Sign in</a>
                    </li>
                <?php endif; ?>

            </ul>
        </div>
    </div>
</nav>