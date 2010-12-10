<?php

$package = FirePHP::to("package"); 

$package->addQuickLink("Custom 1", "http://www.google.com/");
$package->addQuickLink("Custom 2", array(
    "target" => "window",
    "url" => "http://www.google.com/"
));
 
$inspector = FirePHP::to('request');
$inspector->console()->log('Hello World');
