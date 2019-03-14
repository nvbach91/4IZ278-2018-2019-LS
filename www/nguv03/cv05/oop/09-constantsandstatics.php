<?php

class Math {

    const PI = 3.14159265359;
    public static $version = 1.0;

    public function getPI() {
        echo self::PI;
    }
}

$math = new Math();

// const and static can be accessed using the namespace syntax
echo Math::$version, '<br>';
echo Math::PI, '<br>';
echo $math->getPI(), '<br>';

?>