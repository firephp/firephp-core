<?php

// NOTE: You must have FirePHP Companion installed (http://www.christophdorn.com/Tools/)

// See FirePHP Companion for result

define('INSIGHT_CONFIG_PATH', dirname(dirname(dirname(__FILE__))) . DIRECTORY_SEPARATOR . 'package.json');
require_once('FirePHP/Init.php');


$package = FirePHP::to("package"); 

$package->addQuickLink("Link 1", "http://www.firephp.org/");
$package->addQuickLink("Link 2", array(
    "target" => "window",
    "url" => "http://www.firephp.org/"
));

 
$inspector = FirePHP::to('request');
$inspector->console()->log('Hello World');
