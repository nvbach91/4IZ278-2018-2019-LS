<?php foreach($people as $person): ?>
    <div class="row">
        <div class="business-card bc-front">
            <div class="col-sm-4">
                <div class="logo" style="background-image: url(./img/<?php echo $person->avatar; ?>)"></div>
            </div>
            <div class="col-sm-8">
                <div class="bc-firstname"><?php echo $person->firstName; ?></div>
                <div class="bc-lastname"><?php echo $person->lastName; ?></div>
                <div class="bc-title"><?php echo $person->title; ?></div>
                <div class="bc-company"><?php echo $person->company; ?></div>
            </div>
        </div>
        <div class="business-card bc-back">
            <div class="col-sm-6">
                <div class="bc-firstname"><?php echo $person->firstName; ?></div>
                <div class="bc-lastname"><?php echo $person->lastName; ?></div>
                <div class="bc-title"><?php echo $person->title; ?></div>
            </div>
            <div class="col-sm-6 contacts">
                <div class="bc-address"><i class="fas fa-map-marker-alt"></i> <?php echo $person->getAddress(); ?></div>
                <div class="bc-phone"><i class="fas fa-phone"></i> <?php echo $person->phone; ?></div>
                <div class="bc-email"><i class="fas fa-at"></i> <?php echo $person->email; ?></div>
                <div class="bc-website"><i class="fas fa-globe"></i> <?php echo $person->website; ?></div>
                <div class="bc-available"><?php echo $person->getAvailability(); ?></div>
            </div>
        </div>
    </div>
<?php endforeach; ?>