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
}
