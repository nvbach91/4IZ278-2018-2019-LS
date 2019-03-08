<?php

class Clock {

    private function getHours() {
        return date("H");
    }

    private function getMinutes() {
        return date("m");
    }

    private function getSeconds() {
        return date("s");
    }

    public function getTime() {
        echo $this->getHours() . ':' . $this->getMinutes() . ':' . $this->getSeconds();
    }
}

$clock = new Clock();
$clock->getTime();
#$clock->getSeconds();

?>