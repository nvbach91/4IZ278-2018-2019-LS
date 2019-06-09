<?php require_once __DIR__.'/Database.php'; ?>

<?php

class GoodsDB extends Database {
 
    public function create($args){
        $sql = 'INSERT INTO ' . $this->tableName . '(name, description, price) VALUES (:name, :description, :price)';
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            'name' => $args['name'], 
            'description' => $args['description'],
            'price' => $args['price']
        ]);
    }
}

?>