<?php

// NOTE: You must have FirePHP Companion installed (http://companion.firephp.org/)

// See FirePHP Companion for result

putenv('INSIGHT_CONFIG_PATH=' . dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'package.json');
require_once('FirePHP/Init.php');
FirePHP::to('controller')->triggerInspect();


$inspector = FirePHP::to('request');
$console = $inspector->console('Groups');


$console->group('Group1')->log('Group 1 Title');
$console->group('Group2')->log('Group 2 Title');
$console->group('Group1')->log('Message 1');
$console->group('Group2')->log('Message 2');
$console->group('Group1')->log('Message 3');
