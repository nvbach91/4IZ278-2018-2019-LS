<?php require __DIR__ . '/Database.php'; ?>
<?php

class UsersDB extends Database {
    public function fetchAll() {
        return $this->query(
            "SELECT * FROM users"
        );
    }
    public function fetch($args) {
        return $this->query(
            "SELECT * FROM users WHERE Email = '" . $args['email'] . "';"
        );
    }
}

?>