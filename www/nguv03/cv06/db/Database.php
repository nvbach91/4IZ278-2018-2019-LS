<?php require __DIR__ . '/../config/global.php'; ?>
<?php require __DIR__ . '/DatabaseOperations.php'; ?>
<?php

abstract class Database implements DatabaseOperations {
    protected $connection;
    public function __construct() {
        try {
            $this->connection = new PDO(
                'mysql:host=' . DB_HOST . ';dbname=' . DB_DATABASE . ';charset=utf8mb4',
                DB_USERNAME,
                DB_PASSWORD
            );
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Connection to DB failed: " . $e->getMessage());
        } 
    }
    protected function execute($query) {
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    public function fetchBy($field, $value) {
        $query = $this->connection->prepare('SELECT * FROM ' . $this->tableName . ' WHERE ' . $field . ' = ?');
        $query->bindValue(1, $value);
        return $this->execute($query);
    }
}

?>