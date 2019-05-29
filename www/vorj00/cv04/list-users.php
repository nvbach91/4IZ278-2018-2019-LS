<?php require './components/header.php'?>

<?php
$names = [];

$lines = file('./names.txt');
$records = [];

foreach ($lines as $line) {
    $fields = explode(';', $line);
    $record = [
        'name' => $fields[0],
        'gender' => $fields[1],
        'country' => $fields[2],
    ];

    $records[] = $record;
}

?>

<main class="container">
    <ul>
        <?php foreach ($records as $record):
?>
	            <li>
	                <div class="name"><?php echo trim($record['name']); ?></div>
	                <div class="gender"><?php echo trim($record['gender']); ?></div>
	                <div class="country"><?php echo trim($record['country']); ?></div>
	            </li>
	        <?php endforeach;?>
    </ul>
</main>

<?php //file_put_contents(DB_FILE_USERS, $userRecord, FILE_APPEND); ?>

<?php require './components/footer.php'?>