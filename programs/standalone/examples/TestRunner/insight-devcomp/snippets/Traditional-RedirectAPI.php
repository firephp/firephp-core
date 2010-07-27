<?php

// NOTE: You must have FirePHP Companion installed (http://companion.firephp.org/)

// See FirePHP Companion for result

putenv('INSIGHT_CONFIG_PATH=' . dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'package.json');
require_once('FirePHP/Init.php');
FirePHP::to('controller')->triggerInspect();


$firephp = FirePHP::getInstance(true);
$firephp->setLogToInsightConsole('Firebug');
$firephp->log('Hello World');
