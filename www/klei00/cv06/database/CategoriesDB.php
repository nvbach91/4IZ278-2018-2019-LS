<?php require_once __DIR__.'/Database.php'; ?>

<?php

class CategoriesDB extends Database {
 
    public function create($args){
        $sql = 'INSERT INTO ' . $this->tableName . '(name, number) VALUES (:name, :number)';
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            'name' => $args['name'], 
            'number' => $args['number']
        ]);
    }
}

?>