<?php
require __DIR__ . '/../../login.php';
require_once __DIR__ . '/DatabaseInterface.php';

abstract class Database implements DatabaseOperations
{
    protected $pdo;

    public function __construct()
    {
        $this->pdo = new PDO(
            /* DSN */'mysql:host=' . $GLOBALS['host'] . ';dbname=' . $GLOBALS['database'] . ';charset=utf8mb4',
            /* USR */$GLOBALS['username'],
            /* PWD */$GLOBALS['password']
        );
        $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    }

    protected function query($query)
    {
        $result = $this->connection->query($query);
        return [];
    }
}
