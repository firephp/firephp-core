<?php

// NOTE: You must have FirePHP Companion installed (http://companion.firephp.org/)

// See FirePHP Companion for result

define('INSIGHT_CONFIG_PATH', dirname(dirname(dirname(__FILE__))) . DIRECTORY_SEPARATOR . 'package.json');
require_once('FirePHP/Init.php');
FirePHP::to('controller')->triggerInspect();


$inspector = FirePHP::to('request');
$console = $inspector->console('Filters');

$obj = new TestClass();
$console->log($obj);


class TestClass {
    /**
     * @insight filter=on
     */
    public $var1 = 'Variable 1';
    public $var2 = 'Variable 2';
}
