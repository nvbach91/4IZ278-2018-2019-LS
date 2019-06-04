<?php require_once __DIR__.'/Database.php'; ?>

<?php
class OrdersDB extends Database {
 
    public function create($args){
        $sql = 'INSERT INTO ' . $this->tableName . 
            ' (customer ,order_date) VALUES (:customer, NOW())';
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            'customer' => $args
        ]);
    }
}
?> 