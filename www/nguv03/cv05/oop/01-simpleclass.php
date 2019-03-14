<?php

class Simple {
    public $prop = 'prop';
}

$simpleInstance = new Simple;
print_r($simpleInstance);
echo gettype($simpleInstance), '<br>';
echo "Am I an instance of Simple? Answer:", $simpleInstance instanceof Simple;

?>