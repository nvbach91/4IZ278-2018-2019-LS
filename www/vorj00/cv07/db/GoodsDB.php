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
        $sqlTemplate = 'SELECT * FROM goods ORDER BY id LIMIT 10 OFFSET :offset';
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

    public function getGoodsItem()
    {
        $sql = "SELECT * FROM goods WHERE id = :id";
        $statement = $this->pdo->prepare($sql);
        $statement->execute(['id' => $_GET['id']]);
        return $statement->fetchColumn();
    }
}
