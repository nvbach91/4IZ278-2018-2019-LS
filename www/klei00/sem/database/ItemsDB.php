<?php require_once __DIR__.'/Database.php'; ?>

<?php

class ItemsDB extends Database {
 
    public function create($args){
        $sql = 'INSERT INTO ' . $this->tableName . 
            '(order_number, book, unit_price, quantity)
            VALUES (:order_date, :book, :unit_price, :quantity)';
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            'order_date' => $args['order_date'], 
            'book' => $args['book'],
            'unit_price' => $args['unit_price'],
            'quantity' => $args['quantity']
        ]);
    }
}

?>