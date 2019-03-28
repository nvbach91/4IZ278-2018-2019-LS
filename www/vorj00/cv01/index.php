<?php

$logo = 'amazon.png';
$surname = 'Bezos';
$name = 'Jeff';
$position = 'CEO';
$company = 'Amazon';
$street = 'Avenue South';
$streetNumber = 12;
$zipCode = 98144;
$city = 'Seattle';
$phone = '1-206-266-1000';
$email = 'jeff@amazon.com';
$web = 'amazon.com';
$jobAvailable = false;

/* půjčil z https://stackoverflow.com/questions/3776682/php-calculate-age */

$birthDate = "12/01/1964";
//explode the date to get month, day and year
$birthDate = explode("/", $birthDate);
//get age from date or birthdate
$age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
    ? ((date("Y") - $birthDate[2]) - 1)
    : (date("Y") - $birthDate[2]));

?>

<!DOCTYPE html>
<html lang="cs">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Business card</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
</head>

<body>
    <div class="card">
        <div class="card__left">
            <img src="<?php echo $logo ?>" alt="<?php echo $company ?>">
        </div>
        <div class="card__right">
            <div class="card__name"><?php echo $name . ' ' . $surname; ?></div>
            <div class="card__item"><?php echo $position . ' @ ' . $company; ?></div>
            <div class="card__item"><?php echo $phone; ?></div>
            <div class="card__item"><a href="mailto:<?php echo $email ?>"><?php echo $email ?></a></div>
        </div>
    </div>

    <div class="card">
        <div class="card__left card__left--border">
            <div class="card__name"><?php echo $name . ' ' . $surname; ?></div>
            <div class="card__item"><?php echo $position . ' @ ' . $company; ?></div>
        </div>
        <div class="card__right">
            <div class="card__adress">
                <div class="card__item"><?php echo $street . ' ' . $streetNumber ?></div>
                <div class="card__item"><?php echo $city . ', ' . $zipCode ?></div>
            </div>
            <div class="card__item"><?php echo $age ?> let</div>
            <div class="card__item"><a href="<?php echo $web ?>"><?php echo $web ?></a></div>
            <div class="card__item"><?php echo $jobAvailable ? 'Lookin\' for a job' : 'Not lookin\' for a job'; ?></div>
        </div>
    </div>

    <?php require "../hotreload.php";?>
</body>

</html>