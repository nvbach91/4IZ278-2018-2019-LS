<?php require_once __DIR__.'/Database.php'; ?>

<?php

class BooksDB extends Database {
 
    public function create($args){
        $type;
        $i = 1;
        $sql = 'INSERT INTO ' . $this->tableName . 
            '(title, author, price, image, genre)
            VALUES (?, ?, ?, ?, ?)';
        $statement = $this->pdo->prepare($sql);
        foreach($args as $arg){
            switch(true){
                case ($arg===""): $type = PDO::PARAM_NULL; break;
                case is_numeric($arg): $type = PDO::PARAM_INT; break;
                default: $type = PDO::PARAM_STR; break;
            }         
            $statement->bindValue($i++, $arg, $type);            
        }
        $statement->execute();
    }
}

?>