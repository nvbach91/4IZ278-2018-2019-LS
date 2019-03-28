<?php

$obj = [
    'name' => 'something',
    'email' => 'something@else.com',
    'getAdress' => function () {
        return 'This is adress';
    },
];

echo $obj['name'] . '<br>';
echo $obj['getAdress']() . '<br>';

$array = [0, 1, 2];

$array = [
    0 => 'a',
    1 => 'b',
    2 => 'c',
];

$notTrimmedString = "     blab;la  /r";
$trimmedString = trim($notTrimmedString, ' ');

echo $notTrimmedString . '<br>' . $trimmedString . '<br>';

$chars = ['Bar', 'ra', 'bama'];
$name = implode('--', $chars);

echo $name . '<br>';

$true = false;

echo $true ? 'true' : 'false';

?>
<body>
    <?php require 'components/header.php'?>
    <?php require 'components/main.php'?>

    <?php if($true): ?>
        <div>TADÁ</div>
    <?php endif; ?>

    <?php require 'components/footer.php'?>