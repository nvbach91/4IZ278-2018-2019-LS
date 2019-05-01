<?php require_once __DIR__.'/Database.php'; ?>

<?php

class UsersDB extends Database {
 
    public function create($args){
        $sql = 'INSERT INTO ' . $this->tableName . 
            '(first_name, surname, email, phone, password)
            VALUES (:first_name, :surname, :email, :phone, :password)';
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            'first_name' => $args['first_name'], 
            'surname' => $args['surname'],
            'email' => $args['email'],
            'phone' => $args['phone'],
            'password' => $args['password']
        ]);
    }
}

?>