<?php

class Person {
    public function __construct($avatar, $firstName, $lastName, $title, $company, $available, $phone, $email, $website, $street, $propNumber, $orientationNumber, $city) {
        $this->avatar = $avatar;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->title = $title;
        $this->company = $company;
        $this->available = $available;
        $this->phone = $phone;
        $this->email = $email;
        $this->website = $website;
        $this->street = $street;
        $this->propNumber = $propNumber;
        $this->orientationNumber = $orientationNumber;
        $this->city = $city;
    }
    public function getAddress() {
        return $this->street . ' ' . $this->propNumber . '/' . $this->orientationNumber . ', ' . $this->city;
    }

    public function getAvailability() {
        return $this->available ? 'Not available for contracts' : 'Now available for contracts';
    }
}

$person = new Person(
    'jedi-logo.svg',
    'Anakin',
    'Skywalker',
    'Lead Developer / Architect',
    'First Order Jedi Council',
    false,
    '+420 776 889 643',
    'skywalker@jedi-council.com',
    'www.jedi-council.com',
    'Temple of Eedit',
    42,
    121,
    'Coruscant',
);

$person->abc = 'abcdef';

?>
<?php include './header.php'; ?>
<div class="business-card bc-front row">
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
<div class="business-card bc-back row">
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
<?php include './footer.php'; ?>