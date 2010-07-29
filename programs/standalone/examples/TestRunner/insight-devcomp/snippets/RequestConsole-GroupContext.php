<?php

// NOTE: You must have FirePHP Companion installed (http://companion.firephp.org/)

// See FirePHP Companion for result

define('INSIGHT_CONFIG_PATH', dirname(dirname(dirname(__FILE__))) . DIRECTORY_SEPARATOR . 'package.json');
require_once('FirePHP/Init.php');
FirePHP::to('controller')->triggerInspect();


$inspector = FirePHP::to('request');
$console = $inspector->console('Groups');


$group = $console->group('Group1')->open();
$console->log('Group 1 Title');
$console->log('Message 1');

$console->group('Group2')->open();
$console->log('Group 2 Title');
$console->log('Message 2');
$console->group('Group2')->close();

$console->log('Message 3');

$group->close();
