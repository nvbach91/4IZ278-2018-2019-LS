<?php

class Math {

    const PI = 3.14159265359;
    public static $version = 1.0;

    public function getPI() {
        echo self::PI;
    }
}

$math = new Math();

echo Math::$version, PHP_EOL;
echo Math::PI, PHP_EOL;
echo $math->getPI(), PHP_EOL;

?>