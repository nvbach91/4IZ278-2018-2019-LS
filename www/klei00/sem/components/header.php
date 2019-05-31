<!DOCTYPE html>
<html lang="cs">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="knihkupectví">
  <meta name="keywords" content="knihkupectví, knihy, kniha, book, books, beletrie">
  <meta name="author" content="Iveta Kleníková">
  <title>BookShop</title>
  <link rel="shortcut icon" href="/sem/images/icon.png">
  <link rel="stylesheet" href="https://bootswatch.com/4/journal/bootstrap.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="/sem/styles/main.css">
</head>

</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="index.php">
        <img src="/sem/images/icon.png" width="30" height="30" alt="">BookShop</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item<?php echo strpos($_SERVER['REQUEST_URI'], 'index') || preg_match('/\/$/', $_SERVER['REQUEST_URI']) ? ' active' : '' ?>">
            <a class="nav-link" href="index.php">Knihy
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <?php if (isset($_SESSION['userID'])): ?>
            <?php if ((int)$_SESSION['role']<2): ?>
              <li class="nav-item<?php echo strpos($_SERVER['REQUEST_URI'], 'cart') ? ' active' : '' ?>">
                <a class="nav-link" href="cart.php"><i class="fas fa-shopping-cart"></i> Košík</a>
              </li>
            <?php endif; ?>
            <li class="nav-item<?php echo strpos($_SERVER['REQUEST_URI'], 'profile') ? ' active' : '' ?>">
              <a class="nav-link" href="profile.php"><i class="fas fa-user"></i> <?php echo $_SESSION['email']; ?></a>
            </li>
            <li class="nav-item<?php echo strpos($_SERVER['REQUEST_URI'], 'logout') ? ' active' : '' ?>">
              <a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt"></i> Odhlášení</a>
            </li>
          <?php else: ?>
            <li class="nav-item<?php echo strpos($_SERVER['REQUEST_URI'], 'login') ? ' active' : '' ?>">
              <a class="nav-link" href="login.php"><i class="fas fa-sign-in-alt"></i> Přihlášení</a>
            </li>
          <?php endif; ?>
        </ul>
      </div>
    </div>
  </nav>