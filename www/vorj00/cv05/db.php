<?php

interface DatabaseOperations
{
    public function create($args);
    public function fetch($args);
    public function save($args);
    public function delete($args);
}

abstract class Database implements DatabaseOperations
{
    protected $connection;
    protected function query($query)
    {
        $result = $this->connection->query($query);
        return [];
    }
    public function __construct()
    {
        $this->connection = new mysqli(
            "localhost",
            "",
            "",
            "test"
        );
    }
}

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
}

class ProductsDB extends Database
{
    public function create($args)
    {
        return $this->query(
            "INSERT INTO products VALUES ('" . $args['pname'] . "'," . $args['price'] . ")"
        );
    }

    public function fetch($args)
    {
        return $this->query(
            "SELECT * FROM products WHERE Name = '" . $args['pname'] . "'"
        );
    }

    public function save($args)
    {
        return $this->query(
            "UPDATE products SET Price = '" . $args['newPrice'] . "' WHERE Name = '" . $args['pname'] . "'"
        );
    }

    public function delete($args)
    {
        $this->query(
            "DELETE FROM products WHERE Name = '" . $args['pname'] . "'"
        );
    }
}

class OrdersDB extends Database
{
    public function create($args)
    {
        return $this->query(
            "INSERT INTO orders VALUES (" . $args['user'] . "," . $args['product'] . ")"
        );
    }

    public function fetch($args)
    {
        return $this->query(
            "SELECT * FROM orders WHERE user = '" . $args['user'] . "'"
        );
    }

    public function save($args)
    {
        return $this->query(
            "UPDATE orders SET Product = '" . $args['product'] . "' WHERE user = " . $args['user'] . "'"
        );
    }

    public function delete($args)
    {
        $this->query(
            "DELETE FROM orders WHERE User = '" . $args['user'] . "'"
        );
    }
}
