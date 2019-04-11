<?php
require '../header.php';

$records = file('../users.db');
$users = [];
foreach ($records as $record):
    $fields = explode(';', $record);
    $person = [
        'name' => $fields[0],
        'email' => $fields[1],
        'password' => $fields[2]
    ];

    ?>
    <div class="card flex-wrap">
        <div class="card-body">
            <h5 class="card-title"> <?php echo $person['name']; ?> </h5>
            <h6 class="card-subtitle mb-2 text-muted"> <?php echo $person['email']; ?> </h6>
            <p class="card-text"> <?php echo $person['password']; ?> </p>
        </div>
    </div>
<?php
endforeach;
require '../footer.php'; ?>
