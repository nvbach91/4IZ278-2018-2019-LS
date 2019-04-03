<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="mango">
  <meta name="author" content="Iveta Kleníková">
  <title>Mango Shop</title>
  <link rel="shortcut icon" href="https://cdn.iconscout.com/icon/free/png-256/mango-fruit-vitamin-healthy-summer-food-31184.png">
  <link rel="stylesheet" href="https://bootswatch.com/4/journal/bootstrap.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
  <link rel="stylesheet" href="/cv07/styles/main.css">
</head>

</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="index.php">Mango Shop</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item<?php echo strpos($_SERVER['REQUEST_URI'], 'index') || preg_match('/\/$/', $_SERVER['REQUEST_URI']) ? ' active' : '' ?>">
            <a class="nav-link" href="index.php">Home
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <?php if (isset($_COOKIE['name'])): ?>
            <li class="nav-item<?php echo strpos($_SERVER['REQUEST_URI'], 'cart') ? ' active' : '' ?>">
              <a class="nav-link" href="cart.php">Cart</a>
            </li>
            <li class="nav-item<?php echo strpos($_SERVER['REQUEST_URI'], 'profile') ? ' active' : '' ?>">
              <a class="nav-link" href="profile.php"><i class="fas fa-user"></i> <?php echo $_COOKIE['name']; ?></a>
            </li>
            <li class="nav-item<?php echo strpos($_SERVER['REQUEST_URI'], 'logout') ? ' active' : '' ?>">
              <a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </li>
          <?php else: ?>
            <li class="nav-item<?php echo strpos($_SERVER['REQUEST_URI'], 'login') ? ' active' : '' ?>">
              <a class="nav-link" href="login.php">Login</a>
            </li>
          <?php endif; ?>
        </ul>
      </div>
    </div>
  </nav>