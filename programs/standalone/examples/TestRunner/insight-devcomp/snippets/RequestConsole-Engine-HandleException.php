<?php

// NOTE: You must have FirePHP Companion installed (http://www.christophdorn.com/Tools/)

// See FirePHP Companion for result

define('INSIGHT_CONFIG_PATH', dirname(dirname(dirname(__FILE__))) . DIRECTORY_SEPARATOR . 'package.json');
require_once('FirePHP/Init.php');
FirePHP::to('controller')->triggerInspect();


$inspector = FirePHP::to('request');
$console = $inspector->console('Exceptions');

$engine = FirePHP::plugin('engine');
$engine->onException($console);

try {
    throw new Exception('First Test Exception');
} catch(Exception $e) {
    $engine->handleException($e);
}

try {
    throw new Exception('Second Test Exception');
} catch(Exception $e) {
    FirePHP::plugin('engine')->handleException($e);
}
