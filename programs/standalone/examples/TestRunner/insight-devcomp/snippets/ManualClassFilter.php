<?php

// NOTE: You must have FirePHP Companion installed (http://www.christophdorn.com/Tools/)

// See FirePHP Companion or Firebug Console for result (depending on $_GET['target'])

define('INSIGHT_CONFIG_PATH', dirname(dirname(dirname(__FILE__))) . DIRECTORY_SEPARATOR . 'package.json');
require_once('FirePHP/Init.php');

$console = FirePHP::to('page')->console();
if(isset($_GET['target'])) {    // set by the drop-down in the reference
    $console = FirePHP::to($_GET['target'])->console();
    if($_GET['target']=='request') {
        FirePHP::to('controller')->triggerInspect();
    }
}


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
