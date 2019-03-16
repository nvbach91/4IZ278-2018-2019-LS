<?php require __DIR__ . '/Database.php'; ?>
<?php

class ProductsDB extends Database {
    public function fetchAll() {
        return $this->query(
            "SELECT * FROM products"
        );
    }
    public function fetch($args) {
        return $this->query(
            "SELECT * FROM products WHERE id='" . $args['id'] . "'"
        );
    }
}

?>