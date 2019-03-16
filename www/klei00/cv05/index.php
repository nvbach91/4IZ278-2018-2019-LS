<?php

interface DatabaseOperations {
    public function create($args);
    public function fetch();
    public function save();
    public function delete();
}
abstract class Database implements DatabaseOperations {
    protected $path = '/database/';
    protected $extension = '.db';
    public $delimiter = ';';
    public function __construct() {
        echo static::class.' was created'.'<br>';
    }
    public function __toString() {
        return "Configuration".'<br>'.
        "Path: ".$this->path.'<br>'.
        "File name extension: ".$this->extension.'<br>'.
        "Delimiter: ".$this->delimiter.'<br>';
    }
    public function configInfo() { 
        echo $this;
    }
}

class UsersDB extends Database {
    public function create($args) { 
        echo 'User '. $args['name']. ' (age: '. $args['age']. ') was created'. '<br>'; 
    }
    public function fetch()  {
        echo 'A user was fetched'.'<br>';
    }
    public function save()   {
        echo 'A user was saved  '.'<br>';
    }
    public function delete() {
        echo 'A user was deleted'.'<br>';
    }
}

class ProductsDB extends Database {
    public function create($args) { 
        echo 'Product '. $args['name'].' ('. $args['price'].' CZK) was created'.'<br>'; 
    }
    public function fetch()  {
        echo 'A product was fetched'.'<br>';
    }
    public function save()   {
        echo 'A product was saved  '.'<br>';
    }
    public function delete() {
        echo 'A product was deleted'.'<br>';
    }
}
class OrdersDB extends Database {
    public function create($args) { 
        echo 'Order no. '.$args['number'].' was created'.'<br>'; 
    }
    public function fetch()  {
        echo 'An order was fetched'.'<br>';
    }
    public function save()   {
        echo 'An order was saved  '.'<br>';
    }
    public function delete() {
        echo 'An order was deleted'.'<br>';
    }
}

// testing

$alzaCustomers = new UsersDB();
$computers = new ProductsDB();
$orders = new OrdersDB();
echo "-----------------------------".'<br>';
$alzaCustomers->configInfo();
echo "-----------------------------".'<br>';
$computers->configInfo();
echo "-----------------------------".'<br>';
$orders->configInfo();
echo "-----------------------------".'<br>';
$alzaCustomers->create(['name'=>'George', 'age'=>40]);
$alzaCustomers->create(['name'=>'Annie', 'age'=>24]);
$alzaCustomers->create(['name'=>'Jacob', 'age'=>33]);
echo "-----------------------------".'<br>';
$computers->create(['name'=>'Dell', 'price'=>12990]);
$computers->create(['name'=>'HP', 'price'=>18990]);
$computers->create(['name'=>'MacBook', 'price'=>25990]);
echo "-----------------------------".'<br>';
$orders->create(['number'=>100]);
$orders->create(['number'=>101]);
$orders->create(['number'=>102]);
echo "-----------------------------".'<br>';
$alzaCustomers->fetch();
$alzaCustomers->save();
$alzaCustomers->delete();
echo "-----------------------------".'<br>';
$computers->fetch();
$computers->save();
$computers->delete();
echo "-----------------------------".'<br>';
$orders->fetch();
$orders->save();
$orders->delete();
?>