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


$console->group('Group1')->log('Group 1 Title');
$console->expand()->group('Group2')->log('Group 2 Title');
$console->group('Group1')->log('Message 1');
$console->group('Group2')->log('Message 2');
$console->group('Group1')->log('Message 3');
