<?php require_once __DIR__.'/Database.php'; ?>

<?php

class SlidesDB extends Database {
    protected $tableName = 'slides';

    public function fetchAll(){
        $sql = 'SELECT * FROM '.$this->tableName;
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        return $statement->fetchAll();
    }

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