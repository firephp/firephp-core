<?php

// NOTE: You must have FirePHP Companion installed (http://companion.firephp.org/)

// See FirePHP Companion for result

putenv('INSIGHT_CONFIG_PATH=' . dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'package.json');
require_once('FirePHP/Init.php');
FirePHP::to('controller')->triggerInspect();


$inspector = FirePHP::to('request');
$console = $inspector->console('Decorators');

$console->log('Plain message');
$console->label('Label')->log('Labelled message');
