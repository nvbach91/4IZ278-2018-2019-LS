<?php
require_once __DIR__ . './DB.php';

class SlidesDB extends Database
{
    public function fetchAll()
    {
        $sqlTemplate = 'SELECT * FROM slides';
        $statement = $this->pdo->prepare($sqlTemplate);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}
