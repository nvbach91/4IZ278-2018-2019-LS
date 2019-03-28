<?php
require_once __DIR__ . './DB.php';

class ProductsDB extends Database
{
    public function fetchAll()
    {
        $sqlTemplate = 'SELECT * FROM products';
        $statement = $this->pdo->prepare($sqlTemplate);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}
