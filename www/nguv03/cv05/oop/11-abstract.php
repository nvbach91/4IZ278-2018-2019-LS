<?php

abstract class Drawing {
    protected $x = 0;
    protected $y = 0;
    // classes that extend this class must implement this method
    public abstract function area();
    public function getCoordinates() {
        echo "\$x is $this->x", PHP_EOL;
        echo "\$y is $this->y", PHP_EOL;
    }
}

class Circle extends Drawing {
    private $radius;
    public function __construct($x, $y, $r) {
        $this->radius = $r;
        $this->x = $x;
        $this->y = $y;
    }
    public function area() {
        return $this->radius * $this->radius * pi();
    }
    public function __toString() {
        return "Circle, at x: $this->x, y: $this->y, radius: $this->radius";
    }

}

$o = new Circle(12, 45, 22);
// __toString v akci
echo "$o ", PHP_EOL;
echo "Area of the circle: " . $o->area(), PHP_EOL;
echo $o->getCoordinates();

?>