<?php

class Song {

    function __construct() {
        echo "Song object is created", PHP_EOL;
    }

}

$song = new Song();
print_r($song);




class Friend {

    private $born;
    private $name;

    // why is constructor a magic method?
    function __construct($name, $born) {
        $this->name = $name;
        $this->born = $born;
    }

    function getInfo() {
        echo "My friend $this->name was born in $this->born", PHP_EOL;
    }
}

$friend = new Friend("Monika", 1990);
$friend->getInfo();

?>