<?php

use CarbonPHP\Abstracts\Composer;
use CarbonPHP\Error\ThrowableHandler;

// Composer autoload
if (false === ($loader = include $autoloadFile = 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php')) {

    print "<h1>Failed loading Composer at ($autoloadFile). Please run <b>composer install</b>.</h1>";

    die(1);

}

Composer::$loader = $loader;

ThrowableHandler::start();

// the following is a test of the error handler
throw new Exception('This is a test');




