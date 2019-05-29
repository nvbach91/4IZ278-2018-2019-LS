<?php require_once __DIR__.'/Database.php'; ?>

<?php

class GenresDB extends Database {
 
    public function create($args){
        $sql = 'INSERT INTO ' . $this->tableName . 
            '(genre_code, name, description)
            VALUES (:genre_code, :name, :description)';
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            'genre_code' => $args['genre_code'], 
            'name' => $args['name'],
            'description' => $args['description']
        ]);
    }
}

?>