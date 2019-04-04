<?php
require_once __DIR__ . '/DB.php';

class GoodsDB extends Database
{
    public function fetchAll()
    {
        $sqlTemplate = 'SELECT * FROM goods';
        $statement = $this->pdo->prepare($sqlTemplate);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function fetchPage($offset)
    {
        $sqlTemplate = 'SELECT * FROM goods ORDER BY id DESC LIMIT 10 OFFSET :offset';
        $statement = $this->pdo->prepare($sqlTemplate);
        $statement->bindValue(':offset', $offset, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function countPages()
    {
        $sqlTemplate = 'SELECT COUNT(id) FROM goods';
        $statement = $this->pdo->prepare($sqlTemplate);
        $statement->execute();
        return $statement->fetchColumn();
    }
}
