
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <div class="collapse navbar-collapse border-bottom shadow-sm" id="navbarResponsive">
                <h5 class="my-0 mr-md-auto font-weight-normal">E-shop lukostřelby</h5>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item<?php echo strpos($_SERVER['REQUEST_URI'], 'index') || preg_match('/\/$/', $_SERVER['REQUEST_URI']) ? ' active' : '' ?>">
                            <a class="nav-link" href="index.php">Home
                                <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <?php if (isset($_SESSION['id'])): ?>
                        <li class="nav-item<?php echo strpos($_SERVER['REQUEST_URI'], 'cart') ? ' active' : '' ?>">
                            <a class="nav-link" href="cart.php">Košík</a>
                        </li>
                        <li class="nav-item<?php echo strpos($_SERVER['REQUEST_URI'], 'orders') ? ' active' : '' ?>">
                            <a class="nav-link" href="user_orders.php">Mé objednávky</a>
                        </li>
                        <li class="nav-item<?php echo strpos($_SERVER['REQUEST_URI'], 'profile') ? ' active' : '' ?>">
                            <a class="nav-link" href="profile.php"><i class="fas fa-user"></i> <?php echo $_SESSION['email']; ?></a>
                        </li>
                        <li class="nav-item<?php echo strpos($_SERVER['REQUEST_URI'], 'logout') ? ' active' : '' ?>">
                            <a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt"><strong>Odhlásit se</strong></i></a>
                        </li>
                        <?php else: ?>
                        <li class="nav-item<?php echo strpos($_SERVER['REQUEST_URI'], 'login') ? ' active' : '' ?>">
                            <a class="nav-link" href="login.php">Přihlásit se</a>
                        </li>
                        <?php endif; ?>
                </ul>
        </div>
    </div>
</nav>
