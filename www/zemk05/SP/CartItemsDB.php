<?php require_once __DIR__.'/Database.php'; ?>

<?php
class CartItemsDB extends Database {
 
    public function create($args){
        $sql = 'INSERT INTO ' . $this->tableName . 
            '(orders_id, product_id, price, quantity)
            VALUES (:orders_id, :product_id, :price, :quantity)';
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            'orders_id' => $args['orders_id'], 
            'product_id' => $args['product_id'],
            'price' => $args['price'],
            'quantity' => $args['quantity']
        ]);
    }
}
?> 