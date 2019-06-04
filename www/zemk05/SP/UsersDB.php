<?php require_once 'Database.php'; ?>

<?php
class UsersDB extends Database {
    //protected $tableName = 'users_eshop';
 
    public function create($args){
        $sql = 'INSERT INTO ' . $this->tableName . ' (name, surname, email, password, privilege) VALUES (:name, :surname, :email, :password, :privilege)';
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            'name' => $args['name'],
            'surname' => $args['surname'],
            'email' => $args['email'], 
            'password' => $args['password'],
            'privilege' => $args['privilege'], 
        ]);
    }
}
?>