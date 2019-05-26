<html>
<?php
$search = @$_GET['search'];

$title = "$search — Výsledky vyhledávání";
include "include/head.php";
$search_query = new Search();
?>
<body>
<?php
include "include/zahlavi.php";
include "include/menu.php";
?>

<div class="cont text">
<h2><?php echo $search; ?></h2>
<h3>Uživatelé</h3>
    <div class="searchOutput">
        <?php
$search_query->search_user();
?>
    </div>
<h3>Události</h3>
    <div class="searchOutput">
        <?php
$search_query->search_event();
?>
    </div>
</div>
</body>
</html>