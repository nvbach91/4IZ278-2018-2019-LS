<?php require 'database-config.php'; ?>
<?php
interface DatabaseOperations {
    public function fetch($args);
}
abstract class Database implements DatabaseOperations {
    protected $connection;
    public function __construct() {
        $this->connection = new mysqli(
            DB_SERVER_URL, 
            DB_USERNAME, 
            DB_PASSWORD, 
            DB_DATABASE, 
        );
        if ($this->connection->connect_error) {
            die("Connection to DB failed: " . $this->connection->connect_error);
        } 
    }
}
class UsersDB extends Database {
    public function fetch($args) {
        $result = $this->connection->query(
            "SELECT * FROM users WHERE Email = '" . $args['email'] . "'"
        );
        if ($result) {
            return $result->fetch_assoc();
        }
        return [];
    }
}
?>