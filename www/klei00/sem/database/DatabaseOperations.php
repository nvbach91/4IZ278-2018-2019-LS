<?php

interface DatabaseOperations {
    public function create($args);
    public function fetchAll();
    public function fetch($field, $args);
    public function update($conditions, $args);
    public function delete($field, $value);
}

?>