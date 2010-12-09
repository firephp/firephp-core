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


$group = $console->expand()->group('Group1')->open();

    $console->log('Group 1 Title');
    $console->log('Message 1');
    
    $console->expand()->group('Group2')->open();
        $console->log('Group 2 Title');
        $console->log('Message 2');
    $console->group('Group2')->close();
    
    $console->log('Message 3');
    
    $console->group('Group3', 'Group 3 Title')->open();
        $console->log('Message 4');
    $console->group('Group3')->close();

$group->close();
