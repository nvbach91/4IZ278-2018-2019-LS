<?php require_once __DIR__.'/Database.php'; ?>

<?php

class UsersDB extends Database {
 
    public function create($args){
        $sql = 'INSERT INTO ' . $this->tableName . '(email, password) VALUES (:email, :password)';
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            'email' => $args['email'], 
            'password' => $args['password']
        ]);
    }
}

?>