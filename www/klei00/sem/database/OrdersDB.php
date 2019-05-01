<?php require_once __DIR__.'/Database.php'; ?>

<?php

class OrdersDB extends Database {
 
    public function create($args){
        $sql = 'INSERT INTO ' . $this->tableName . 
            '(order_date, total_price, customer)
            VALUES (:order_date, :total_price, :customer)';
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            'order_date' => $args['order_date'], 
            'total_price' => $args['total_price'],
            'customer' => $args['customer']
        ]);
    }
}

?>