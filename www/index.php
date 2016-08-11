<?php

//autoload 
define("DATA_PATH", __DIR__ . '/../data');
define("APPLICATION_PATH", __DIR__ . '\..\application');

include_once('autoloader.php');

Application\Bootstrap::run();