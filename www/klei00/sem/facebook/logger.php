<?php
require_once __DIR__.'/vendor/autoload.php'; 

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

// create a log channel
$log = new Logger('name');
$log->pushHandler(new StreamHandler('log.txt', Logger::WARNING));
?>