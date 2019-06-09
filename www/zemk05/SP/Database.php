<?php require_once 'dbOperations.php'; ?>

<?php
const DB_HOST = 'localhost';
const DB_DATABASE = 'test';
const DB_USERNAME = 'zemk05';
const DB_PASSWORD = 'xxxxx';
const GLOBAL_CURRENCY = 'Kč';

abstract class Database implements DatabaseOperations {
    protected $path = '/db/';
    protected $extension = '.db';
    public $delimiter = ';';
    protected $pdo;
    protected $tableName;
    
    public function __construct($tableName){
        $this->tableName = $tableName;
        $this->pdo = new PDO ('mysql:host='.DB_HOST.';dbname='.DB_DATABASE.';charset=utf8mb4', DB_USERNAME, DB_PASSWORD);
        $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    }    
    public function fetchAll(){
        $sql = 'SELECT * FROM '.$this->tableName;
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        return $statement->fetchAll();
    }
    public function fetchAllOrder($order){
        $sql = 'SELECT * FROM '.$this->tableName.' ORDER BY '.$order.' ASC';
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        return $statement->fetchAll();
    }
    public function fetchBy($field, $value){
        $sql = 'SELECT * FROM '.$this->tableName.' WHERE '.$field.' = :value';
        $statement = $this->pdo->prepare($sql);
        $statement->execute(['value'=>$value]);
        return $statement->fetchAll();
    }
    public function updateBy($conditions, $args){
        $sets = [];
        $whereConditions = [];
        foreach($args as $key => $value) {
            $sets[] = $key . ' = :' . $key;
        }
        foreach($conditions as $key => $value) {
            $whereConditions[] = $key . ' = :' . $key;
        }
        $sql = 'UPDATE ' . $this->tableName . ' SET '.implode(', ', $sets).' WHERE '.implode(' && ', $whereConditions);
        
        echo $sql;
        $statement = $this->pdo->prepare($sql);
        foreach($args as $key => $value) {
            $statement->bindValue(':' . $key, $value);
        }
        foreach($conditions as $key => $value) {
            $statement->bindValue(':' . $key, $value);
        }
        $statement->execute();
    }


    public function deleteBy($field, $value){
        $sql = 'DELETE FROM ' . $this->tableName . ' WHERE ' . $field . ' = :value';
        $statement = $this->pdo->prepare($sql);
        $statement->execute(['value' => $value]);
    }

    public function getPDO(){
        return $this->pdo;
    }
}

?>