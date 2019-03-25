<?php require_once __DIR__.'/Database.php'; ?>

<?php

class SlidesDB extends Database {

    public function create($args){
        $sql = 'INSERT INTO ' . $this->tableName . '(title, url) VALUES (:title, :url)';
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            'title' => $args['title'], 
            'url' => $args['url']
        ]);
    }
}

?>