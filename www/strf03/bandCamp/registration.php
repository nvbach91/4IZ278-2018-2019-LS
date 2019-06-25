<?php require __DIR__ . '/incl/header.php' ?>

<main class="container">
    <div class="card-deck mb-2 text-center">
        <div class="card mb-4 shadow-sm">
            <div class="card-header">
                <h4 class="my-0 font-weight-normal">Kapela</h4>
            </div>
            <div class="card-body">
                <h1 class="card-title pricing-card-title">Založ kapelu</h1>
                <img class="card-img-top" src="./images/site/band.png" alt="Card image" style="height: 100px; width:100px;">
                <ul class="list-unstyled mt-3 mb-4">
                    <li>Prezentujte své skladby a videa</li>
                    <li>Získejte nové fanoušky</li>
                    <li>Novinky v kapele</li>
                </ul>
                <a href="band_registration.php" class="btn btn-lg btn-block btn-dark">Zaregistruj kapelu</a>
            </div>
        </div>
        <div class="card mb-4 shadow-sm">
            <div class="card-header">
                <h4 class="my-0 font-weight-normal">Hudebník</h4>
            </div>
            <div class="card-body">
                <h1 class="card-title pricing-card-title">Založ si profil hudebníka</h1>
                <img class="card-img-top" src="./images/site/singer.png" alt="Card image" style="height: 100px; width:100px;">
                <ul class="list-unstyled mt-3 mb-4">
                    <li>Informace o tobě</li>
                    <li>Objev nové kapely a kámoše</li>
                    <li>Sdílej svůj hudební vkus</li>
                </ul>
                <a href="user_registration.php" class="btn btn-lg btn-block btn-dark">Zaregistruj hudebníka</a>
            </div>
        </div>
    </div>
</main>
    <div style="margin-bottom: 300px"></div>
    <?php require __DIR__ . '/incl/footer.php' ?>
