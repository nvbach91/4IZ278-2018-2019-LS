<?php require_once __DIR__.'/Database.php'; ?>

<?php

class OrdersDB extends Database {
 
    public function create($args){
        $sql = 'INSERT INTO ' . $this->tableName . 
            '(order_date, customer)
            VALUES (NOW(), :customer)';
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            'customer' => $args
        ]);
    }
}

?>