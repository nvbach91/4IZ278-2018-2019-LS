<?php


interface DatabaseOperations {
    public function fetch();
    public function create($args);
    public function save();
    public function delete();
}


abstract class Database implements DatabaseOperations {

    protected $path = './file/db/';
    protected $extension = '.db';
    protected $delimiter = ';';


    public function __construct() {
        echo '-----', static::class, ' was instantiated-----', PHP_EOL;
    }
    public function __toString() {
        return "database config: dbPath: $this->path, dbExtenstion: $this->extension, delimiter: $this->delimiter";
    }
}
class UsersDB extends Database {
    public function create($args) {
        echo 'User '  . $args['name'] . ' age: ' . $args['age'] . ' is alive, IS ALIVE.' . PHP_EOL;
    }
    public function fetch()  { echo 'User for your experiments master.', PHP_EOL; }
    public function save()   { echo 'Returning user to prison master  ', PHP_EOL; }
    public function delete() { echo 'This servant will dispose of this user master.', PHP_EOL; }
}
class ProductsDB extends Database {
    public function create($args) {
        echo 'Product ' . $args['name'] . ' $' . $args['price'] . ' is alive, IS ALIVE.' . PHP_EOL;
    }
    public function fetch()  { echo 'Here is requested tool master', PHP_EOL; }
    public function save()   { echo 'Returning tool to its place master', PHP_EOL; }
    public function delete() { echo 'Disposing of given tool master', PHP_EOL; }
}
class OrdersDB extends Database {
    public function create($args) {
        echo 'Order no. ' . $args['number'] . ' is alive, IS ALIVE.' . PHP_EOL;
    }
    public function fetch()  { echo 'This is the order i have been given master.', PHP_EOL; }
    public function save()   { echo 'The order has been remembered master.', PHP_EOL; }
    public function delete() { echo 'The order has been forgotten master.', PHP_EOL; }
}