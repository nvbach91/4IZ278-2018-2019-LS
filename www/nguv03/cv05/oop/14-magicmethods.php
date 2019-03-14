<?php
/**
 * Magické metody umožňují programátorovi přenést na PHP starost o některé 
 * speciální a jiným způsobem těžko proveditelné úkoly, nezbytné při práci s OOP.
 */

class ExampleMagic {
    private $info = "Magical Mallet!";
    public function __toString() {
        return $this->info;
    }
}

$e = new ExampleMagic();
// tady se zavolá __toString()
echo $e, '<br>', '<br>';



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
echo "a: ", $m->a, '<br>';
echo "x: ", $m->x, '<br>';
echo "b: ", $m->b, '<br>';
// calls __set
$m->b = "BbbBB";
echo "b: ", $m->b, '<br>';
// calls __set
$m->x = "XxxXXXX";
echo "x: ", $m->x, '<br>';

// calls __unset
unset($m->b);

// calls __isset
echo "x isset: ", isset($m->x), '<br>';
echo "b isset: ", isset($m->b), '<br>';

// more magic methods:
// __clone, __construct, __invoke, __toString, 

?>
