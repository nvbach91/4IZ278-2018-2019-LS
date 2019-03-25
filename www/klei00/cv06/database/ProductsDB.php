<?php require_once __DIR__.'/Database.php'; ?>

<?php

class ProductsDB extends Database {

    public function create($args){
        $sql = 'INSERT INTO ' . $this->tableName . '(name, price, img) VALUES (:name, :price, :img)';
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            'name' => $args['name'], 
            'price' => $args['price'], 
            'img' => $args['img'],
        ]);
    }
}

?>