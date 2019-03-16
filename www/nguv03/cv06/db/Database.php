<?php require __DIR__ . '/../config/global.php'; ?>
<?php require __DIR__ . '/DatabaseOperations.php'; ?>
<?php

abstract class Database implements DatabaseOperations {
    protected $connection;
    public function __construct() {
        $this->connection = new mysqli(
            DB_SERVER_URL, 
            DB_USERNAME, 
            DB_PASSWORD, 
            DB_DATABASE
        );
        if ($this->connection->connect_error) {
            die("Connection to DB failed: " . $this->connection->connect_error);
        } 
    }
    protected function query($query) {
        $results = [];
        $queryResult = $this->connection->query($query);
        if (!$queryResult) {
            die($this->connection->error);
        }
        if ($queryResult->num_rows) {
            while($row = $queryResult->fetch_assoc()) {
                $results[] = $row;
            }
        }
        return $results;
    }
}

?>