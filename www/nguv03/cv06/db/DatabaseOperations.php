<?php 

interface DatabaseOperations {
    public function fetchAll();
    public function fetchBy($field, $value);
    // other operations CRUD
}

?>