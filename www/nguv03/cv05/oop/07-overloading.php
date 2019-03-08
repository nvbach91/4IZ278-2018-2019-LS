<?php

class Mathe {
    public function getSum() {
        $args = func_get_args();
        if (empty($args)) {
            return 0;
        }
        $sum = 0;
        foreach ($args as $arg) {
            $sum += $arg;
        }
        return $sum;
    }
}

$s = new Mathe();
echo $s->getSum(), PHP_EOL;
echo $s->getSum(5), PHP_EOL;
echo $s->getSum(3, 4), PHP_EOL;
echo $s->getSum(3, 4, 7), PHP_EOL;

?>