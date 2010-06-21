<?php

// NOTE: You must have FirePHP Companion installed (http://companion.firephp.org/)

// See FirePHP Companion for result

putenv('INSIGHT_CONFIG_PATH=' . dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'package.json');
require_once('FirePHP/Init.php');
FirePHP::to('controller')->triggerInspect();


$inspector = FirePHP::to('request');
$console = $inspector->console('Filters');

// apply filter
$filter = array(
    'classes' => array(
        'TestClass' => array('var1')
    )
);
$console = $console->filter($filter);

// send object
$obj = new TestClass();
$console->log($obj);


class TestClass {
    public $var1 = 'Variable 1';
    public $var2 = 'Variable 2';
}
