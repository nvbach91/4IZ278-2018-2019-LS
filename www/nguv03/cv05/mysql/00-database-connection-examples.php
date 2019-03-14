<?php
$servername = "localhost";
$database = "test";
$username = "root";
$password = "root";
?>

<?php
// Create connection object oriented style
$connection = new mysqli($servername, $username, $password, $database);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
} 
echo "Connected successfully OOP STYLE" . PHP_EOL;
// you can close manually, 
// otherwise the connection will close automatically when the script ends
$connection->close();
echo "Connection closed" . PHP_EOL;
?>


<?php
// Create connection in procedural style
$connection = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
} 
echo "Connected successfully PROCEDURAL STYLE" . PHP_EOL;
// you can close manually, 
// otherwise the connection will close automatically when the script ends
mysqli_close($connection);
echo "Connection closed" . PHP_EOL;
?>


<?php
try {
    $connection = new PDO("mysql:host=$servername;dbname=test", $username, $password);
    // set the PDO error mode to exception
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully PDO STYLE" . PHP_EOL; 
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
$connection = null;
echo "Connection closed" . PHP_EOL;
?>