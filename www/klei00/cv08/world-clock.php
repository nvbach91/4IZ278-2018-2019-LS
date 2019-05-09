<?php
$cities = [];

date_default_timezone_set('Europe/Prague');
$city = [
    'name' => 'Prague',
    'date' => date('j.n. Y H:i:s'),
    'img' => 'https://www.telegraph.co.uk/content/dam/Travel/commerce-partners/ile/Productimage/redandbluedesignhotelprague/RESTRICTED-ILE-redbluedesignhotel-prague-product-TRAVEL-xlarge.jpg'
];
array_push($cities, $city);

date_default_timezone_set('Australia/Sydney');
$city = [
    'name' => 'Sydney',
    'date' => date('F d, Y H:i:s'),
    'img' => 'https://media-cdn.tripadvisor.com/media/photo-s/13/93/a7/cc/sydney-opera-house.jpg'
];
array_push($cities, $city);

date_default_timezone_set('America/New_York');
$city = [
    'name' => 'New York',
    'date' => date('m/d/Y H:i:s'),
    'img' => 'https://www.telegraph.co.uk/content/dam/Travel/Destinations/North%20America/USA/New%20York/Attractions/statue-of-liberty-new-york-p.jpg?imwidth=450'
];
array_push($cities, $city);

date_default_timezone_set('Africa/Nairobi');
$city = [
    'name' => 'Nairobi',
    'date' => date('Y/m/d H:i:s'),
    'img' => 'https://micato-woz6qxzwhvcnrugsanv.netdna-ssl.com/wp-content/uploads/2018/09/Nairobi_Skyline-1110x700.jpg'
];
array_push($cities, $city);

date_default_timezone_set('Europe/London');
$city = [
    'name' => 'London',
    'date' => date('jS F Y H:i:s'),
    'img' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/8/87/Palace_of_Westminster_from_the_dome_on_Methodist_Central_Hall.jpg/1000px-Palace_of_Westminster_from_the_dome_on_Methodist_Central_Hall.jpg'
];
array_push($cities, $city);

date_default_timezone_set('Europe/Moscow');
$city = [
    'name' => 'Moscow',
    'date' => date('d F Y H:i:s'),
    'img' => 'https://higherlogicdownload.s3.amazonaws.com/IMANET/0be307fc-98fd-412d-b879-ae9a90f110de/UploadedImages/Moscow.jpg'
];
array_push($cities, $city);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://bootswatch.com/4/journal/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <meta name="description" content="world clock">
    <meta name="author" content="Iveta Kleníková">
    <title>World Clock</title>
</head>
<body>
<main class="container">
<h1>World Clock</h1>
<div class="row">
<?php foreach($cities as $city): ?>
    <div class="card" style="width:calc(100% / 3);">
        <img class="card-img-top" src="<?php echo $city['img']; ?>" alt="Image of <?php echo $city['img']; ?>">
        <div class="card-body">
            <h5 class="card-title"><?php echo $city['name']; ?></h5>
            <p class="card-text"><?php echo $city['date']; ?></p>
        </div>
    </div>
<?php endforeach; ?>
</div>
</main>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/js/bootstrap.min.js"></script>
</body>
</html>