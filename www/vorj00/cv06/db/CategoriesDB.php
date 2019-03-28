<?php
require_once __DIR__ . './DB.php';

class CategoriesDB extends Database
{
    public function fetchAll()
    {
        $sqlTemplate = 'SELECT * FROM categories';
        $statement = $this->pdo->prepare($sqlTemplate);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}
