<?php require __DIR__ . '/incl/header.php';?>

<?php require __DIR__ . '/incl/nav.php';?>

<?php

date_default_timezone_set("Europe/Prague");

$cities = [
    'Africa/Niamey',
    'America/Havana',
    'Antarctica/Vostok',
    'Arctic/Longyearbyen',
    'Asia/Baghdad',
];

?>

  <table class="table">
      <thead>
        <tr>
          <th>City</th>
          <th>Current time</th>
          <th>Difference between us</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($cities as $city): ?>
        <tr>
          <td><?php echo explode("/", $city)[1]; ?></td>
          <td><?php echo (new DateTime('now', new DateTimeZone($city)))->format('Y-m-d H:i:s'); ?></td>
          <td>
          <?php 
          $difference = (strtotime((new DateTime('now', new DateTimeZone($city)))->format('Y-m-d H:i:s')) - time()) / 3600; 
          echo $difference === 1 ? $difference . ' hour' : $difference . ' hours';
          ?>
          </td>
        </tr>
      <?php endforeach;?>
      </tbody>
    </table>

<?php require __DIR__ . '/incl/footer.php';?>