<?php require __DIR__ . '/Database.php'; ?>
<?php
class ProductsDB extends Database {
    protected $tableName = 'products_eshop';
    public function fetchAll() {
        $sql = 'SELECT * FROM ' . $this->tableName;
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        return $statement->fetchAll();
    }
    public function create($args) {
        $sql = 'INSERT INTO ' . $this->tableName . '(name,description, price, img) VALUES (:name, :description, :price, :img)';
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            'name' => $args['name'], 
            'description' => $args['description'], 
            'price' => $args['price'], 
            'img' => $args['img'],
        ]);
    }
}
?>