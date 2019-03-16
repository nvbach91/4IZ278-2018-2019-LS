<?php require __DIR__ . '/Database.php'; ?>
<?php

class ProductsDB extends Database {
    protected $tableName = 'products';
    public function fetchAll() {
        $query = $this->connection->prepare('SELECT * FROM ' . $this->tableName);
        return $this->execute($query);
    }
}

?>