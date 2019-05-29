<?php

class Person
{
    public $logo;
    public $name;
    public $surname;
    public $position;
    public $company;
    public $street;
    public $streetNumber;
    public $zipCode;
    public $city;
    public $phone;
    public $email;
    public $web;
    public $jobAvailable;
    private $birthDate;

    public $age;

    public function __construct(
        $logo,
        $name,
        $surname,
        $position,
        $company,
        $street,
        $streetNumber,
        $zipCode,
        $city,
        $phone,
        $email,
        $web,
        $jobAvailable,
        $birthDate
    ) {
        $this->logo = $logo;
        $this->name = $name;
        $this->surname = $surname;
        $this->position = $position;
        $this->company = $company;
        $this->street = $street;
        $this->streetNumber = $streetNumber;
        $this->zipCode = $zipCode;
        $this->city = $city;
        $this->phone = $phone;
        $this->email = $email;
        $this->web = $web;
        $this->jobAvailable = $jobAvailable;
        $this->birthDate = $birthDate;
    }

    public function getFullName()
    {
        return $this->name . ' ' . $this->surname;
    }

    public function getAge()
    {
        /* půjčil z https://stackoverflow.com/questions/3776682/php-calculate-age */

        //explode the date to get month, day and year
        $birthDate = explode("/", $this->birthDate);
        //get age from date or birthdate
        $this->age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
            ? ((date("Y") - $birthDate[2]) - 1)
            : (date("Y") - $birthDate[2]));
        return $this->age;
    }

    public function setBirthDate($birthDate)
    {
        $this->birthDate = $birthDate;
    }

    public function setName($name)
    {
        $this->$name = $name;
    }
}

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
$birthDate = "12/01/1964";

//$jeff = new Person('amazon.png', 'Jeff', 'Bezos');
$jeff = new Person($logo,
    $name,
    $surname,
    $position,
    $company,
    $street,
    $streetNumber,
    $zipCode,
    $city,
    $phone,
    $email,
    $web,
    $jobAvailable,
    $birthDate);
$steve = new Person('apple.png',
    'Steve',
    'Jobs',
    'CEO',
    'Apple',
    'Apple Park Way',
    1,
    95014,
    'California',
    '(408) 996–1010',
    'steve@apple.com',
    'apple.com',
    true,
    '24/02/1955');
$bill = new Person('microsoft.png',
    'Bill',
    'Gates',
    'ex CEO',
    'Microsoft',
    'No matter where',
    42,
    95014,
    'California',
    '(800) 426-9400',
    'bill@msft.com',
    'microsoft.com',
    true,
    '28/11/1955');

$people = [$jeff];
array_push($people, $steve);
array_push($people, $bill);

// for($i = 0; $i < sizeof($people); $i++){
//     echo $people[$i]->surname;
//     echo '<br>';
// };

//  foreach ($people as $person) {
//      # code...
//      echo $person->surname;
//      echo '<br>';
// }

//var_dump($people);

// echo $jeff->name;
// echo '<br>';
// echo $jeff->surname;
// $jeff->setBirthDate($birthDate);

// echo '<br>';

// echo $steve->name;
// echo '<br>';
// echo $steve->surname;
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
    <?php foreach ($people as $person): ?>

    <div class="card">
        <div class="card__left">
            <img src="<?php echo $person->logo ?>" alt="<?php echo $person->company ?>">
        </div>
        <div class="card__right">
            <div class="card__name"><?php echo $person->getFullName(); ?></div>
            <div class="card__item"><?php echo $person->position . ' @ ' . $person->company; ?></div>
            <div class="card__item"><?php echo $person->phone; ?></div>
            <div class="card__item"><a href="mailto:<?php echo $person->email ?>"><?php echo $person->email ?></a></div>
        </div>
    </div>

    <div class="card">
        <div class="card__left card__left--border">
            <div class="card__name"><?php echo $person->getFullName(); ?></div>
            <div class="card__item"><?php echo $person->position . ' @ ' . $person->company; ?></div>
        </div>
        <div class="card__right">
            <div class="card__adress">
                <div class="card__item"><?php echo $person->street . ' ' . $person->streetNumber ?></div>
                <div class="card__item"><?php echo $person->city . ', ' . $person->zipCode ?></div>
            </div>
            <div class="card__item"><?php echo $person->getAge() ?> let</div>
            <div class="card__item"><a href="<?php echo $person->web ?>"><?php echo $web ?></a></div>
            <div class="card__item"><?php echo $person->jobAvailable ? 'Lookin\' for a job' : 'Not lookin\' for a job'; ?></div>
        </div>
    </div>

<?php endforeach;?>
<?php require "../hotreload.php";?>
</body>
</html>