<?php

require './Person.php';

$people = [];

array_push($people, new Person(
    'jedi-logo.svg',
    'Anakin',
    'Skywalker',
    'Temple Knight / Architect',
    'First Order Jedi Council',
    false,
    '+420 777 888 542',
    'skywalker@jedi-council.com',
    'www.jedi-council.com',
    'Temple of Eedit',
    42,
    121,
    'Coruscant'
));

array_push($people, new Person(
    'jedi-master-logo.svg',
    'Obi-wan',
    'Kenobi',
    'Master Artist / Lector',
    'First Order Jedi Council',
    true,
    '+420 775 456 789',
    'kenobi@jedi-council.com',
    'www.jedi-council.com',
    'Temple of Eedit',
    43,
    121,
    'Coruscant'
));

array_push($people, new Person(
    'galactic-republic-logo.svg',
    'Padmé',
    'Amidala',
    'Senator of Naboo / Queen',
    'the Galactic Senate',
    true,
    '+420 775 456 789',
    'amidala@galactic-senate.com',
    'www.galactic-senate.com',
    'Senate District',
    874,
    12,
    'Naboo'
));

?>
<?php require './header.php'; ?>
<main class="container">
    <h1 class="text-center">My Business Card in PHP OOP Style</h1>
    <?php require './business-card.php'; ?>
</main>
<?php require './footer.php'; ?>
