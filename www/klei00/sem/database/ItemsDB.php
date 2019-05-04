<?php require_once __DIR__.'/Database.php'; ?>

<?php

class ItemsDB extends Database {
 
    public function create($args){
        $sql = 'INSERT INTO ' . $this->tableName . 
            '(order_number, book, unit_price, quantity)
            VALUES (:order_number, :book, :unit_price, :quantity)';
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            'order_number' => $args['order_number'], 
            'book' => $args['book'],
            'unit_price' => $args['unit_price'],
            'quantity' => $args['quantity']
        ]);
    }
}

?>