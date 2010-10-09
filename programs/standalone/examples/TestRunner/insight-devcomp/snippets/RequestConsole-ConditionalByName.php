<?php

// NOTE: You must have FirePHP Companion installed (http://www.christophdorn.com/Tools/)

// See FirePHP Companion for result

define('INSIGHT_CONFIG_PATH', dirname(dirname(dirname(__FILE__))) . DIRECTORY_SEPARATOR . 'package.json');
require_once('FirePHP/Init.php');
FirePHP::to('controller')->triggerInspect();


$inspector = FirePHP::to('request');
$console = $inspector->console('Conditional');


$console->on('Condition 1')->log('Condition 1 - Message 1');
$console->on('Condition 2')->log('Condition 2 - Message 2');
$console->on('Condition 1')->log('Condition 1 - Message 3');
$console->on('Condition 2')->log('Condition 2 - Message 4');
$console->on('Condition 1')->log('Condition 1 - Message 5');
