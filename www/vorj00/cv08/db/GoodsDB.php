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

    public function create($args){
        $sql = 'INSERT INTO goods (name, description, price) VALUES (:name, :description, :price)';
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(':name', $args['name'], PDO::PARAM_STR);
        $statement->bindValue(':description', $args['description'], PDO::PARAM_STR);
        $statement->bindValue(':price', $args['price'], PDO::PARAM_INT);
        $statement->execute();
    }

    public function update($args){
        $sql = 'UPDATE goods SET name = :name, description = :description, price = :price WHERE id = :id';
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(':id', $args['id'], PDO::PARAM_INT);
        $statement->bindValue(':name', $args['name'], PDO::PARAM_STR);
        $statement->bindValue(':description', $args['description'], PDO::PARAM_STR);
        $statement->bindValue(':price', $args['price'], PDO::PARAM_INT);
        $statement->execute();
    }

    public function delete($id){
        $sql = 'DELETE FROM goods WHERE id = :id';
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();
    }

    public function getGoodsItem($id)
    {
        $sql = "SELECT * FROM goods WHERE id = :id";
        $statement = $this->pdo->prepare($sql);
        $statement->execute(['id' => $id]);
        return $statement->fetchColumn();
    }

    public function getGoodsWholeItem($id)
    {
        $sql = "SELECT * FROM goods WHERE id = :id";
        $statement = $this->pdo->prepare($sql);
        $statement->execute(['id' => $id]);
        return $statement->fetch();
    }
    
    public function getCart($ids)
    {
        $question_marks = str_repeat('?,', count($ids) - 1) . '?';
        $sql = "SELECT * FROM goods WHERE id IN ($question_marks) ORDER BY name";
        $statement = $this->pdo->prepare($sql);
        # array values - setrepeme pole aby bylo indexovane od 0, jen kvuli dotazu, jinak neprojde
        $statement->execute(array_values($ids));
        return $statement->fetchAll();
    }

    public function getCartPrice($ids)
    {
        $question_marks = str_repeat('?,', count($ids) - 1) . '?';
        $sql = "SELECT COUNT price FROM goods WHERE id IN ($question_marks)";
        $statement = $this->pdo->prepare($sql);
        # array values - setrepeme pole aby bylo indexovane od 0, jen kvuli dotazu, jinak neprojde
        $statement->execute(array_values($ids));
        return $statement->fetchColumn();
    }

}
