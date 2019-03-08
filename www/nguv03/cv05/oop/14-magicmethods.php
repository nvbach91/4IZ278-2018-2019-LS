<?php

// access class members using magic methods
class MagicClass {
    public $a = 'A';
    protected $b = 'B';
    private $c = 'C';
    private $data = [];

    public function __get($varName) {
        if (property_exists($this, $varName)) {
            return $this->$varName;
        } elseif (isset($this->data[$varName])) {
            return $this->data[$varName];
        }
        return null;
    }

    public function __set($varName, $value) {
        if (property_exists($this, $varName)) {
            $this->$varName = $value;
        } else {
            $this->data[$varName] = $value;
        }
    }

    public function __isset($varName) {
        return property_exists($this, $varName) || isset($this->data[$varName]);
    }

    public function __unset($varName) {
        if (property_exists($this, $varName)) {
            unset($this->$varName);
        } elseif(isset($this->data[$varName])) {
            unset($this->data[$varName]);
        }
    }
}

$m = new MagicClass();

// calls __get
echo "a: ", $m->a, PHP_EOL;
echo "x: ", $m->x, PHP_EOL;
echo "b: ", $m->b, PHP_EOL;
// calls __set
$m->b = "BbbBB";
echo "b: ", $m->b, PHP_EOL;
// calls __set
$m->x = "XxxXXXX";
echo "x: ", $m->x, PHP_EOL;

// calls __unset
unset($m->b);

// calls __isset
echo "x isset: ", isset($m->x), PHP_EOL;
echo "b isset: ", isset($m->b), PHP_EOL;

// more magic methods:
// __clone, __construct, __invoke, __toString, 

?>
