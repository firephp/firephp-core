<?php

// NOTE: You must have FirePHP Companion installed (http://companion.firephp.org/)

// See FirePHP Companion for result

define('INSIGHT_CONFIG_PATH', dirname(dirname(dirname(__FILE__))) . DIRECTORY_SEPARATOR . 'package.json');
require_once('FirePHP/Init.php');
FirePHP::to('controller')->triggerInspect();


$inspector = FirePHP::to('request');
$console = $inspector->console('Conditional');


$on = $console->on('Condition 1')->open();
$console->log('Condition 1 - Message 1');

$console->on('Condition 2')->open();
$console->log('Condition 2 - Message 2');
$console->on('Condition 2')->close();

$console->log('Condition 1 - Message 3');

$on->close();
