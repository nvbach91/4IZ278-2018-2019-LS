<?php require __DIR__ . '/Database.php'; ?>
<?php

class UsersDB extends Database {
    protected $tableName = 'users';
    public function fetchAll() {
        $query = $this->connection->prepare('SELECT * FROM ' . $this->tableName);
        return $this->execute($query);
    }
}

?>