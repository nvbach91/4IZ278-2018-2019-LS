<?php
require_once __DIR__ . '/DB.php';

class UsersDB extends Database
{
    public function create($args)
    {
        return $this->query(
            "INSERT INTO users VALUES ('" . $args['fname'] . "'," . $args['age'] . ",'" . $args['email'] . "')"
        );
    }

    public function fetch($args)
    {
        return $this->query(
            "SELECT * FROM users WHERE Email = '" . $args['email'] . "'"
        );
    }

    public function save($args)
    {
        return $this->query(
            "UPDATE users SET Email = '" . $args['newEmail'] . "' WHERE Email = '" . $args['email'] . "'"
        );
    }

    public function delete($args)
    {
        $this->query(
            "DELETE FROM users WHERE Email = '" . $args['email'] . "'"
        );
    }

    public function fetchAll()
    {
        $sqlTemplate = 'SELECT * FROM users';
        $statement = $this->pdo->prepare($sqlTemplate);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAuthority($id)
    {
        $sql = "SELECT authority FROM users WHERE id = :id";
        $statement = $this->pdo->prepare($sql);
        $statement->execute(['id' => $id]);
        return intval($statement->fetchColumn());
    }

    public function editAuthority($args)
    {
        $sql = 'UPDATE users SET authority = :authority WHERE id = :id';
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(':id', $args['id'], PDO::PARAM_INT);
        $statement->bindValue(':authority', $args['authority'], PDO::PARAM_INT);
        $statement->execute();
    }
}
