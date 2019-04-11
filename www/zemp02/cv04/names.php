<?php require './header.php';?>

<?php
$records = file('./users.db');


$persons=[];
foreach ($records as $record){
    $fields = explode(';',$record);

    $person = [
        'name'=>$fields[0],
        'gender'=>$fields[1],
        'age'=>$fields[2],
        'town'=>$fields[3]
    ];

    $persons[] = $person;
}





?>
<main>
    <ul>
        <?php foreach ($persons as $person):?>
        <li>
            <div class = "name"><?php echo $person['name']; ?></div>
            <div class = "gender"><?php echo $person['gender']; ?></div>
            <div class = "age"><?php echo $person['age']; ?></div>
            <div class = "town"><?php echo $person['town']; ?></div>
        </li>
        <?php endforeach; ?>
    </ul>

</main>

<?php require './footer.php';?>
