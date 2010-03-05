<?php

ini_set('display_errors', '0');


$firephp = FirePHP::getInstance(true);

$firephp->registerExceptionHandler();

throw new Exception('Test Exception');