<?php

// NOTE: You must have FirePHP Companion installed (http://www.christophdorn.com/Tools/)

// See FirePHP Companion or Firebug Console for result (depending on $_GET['target'])

define('INSIGHT_CONFIG_PATH', dirname(dirname(dirname(__FILE__))) . DIRECTORY_SEPARATOR . 'package.json');

// force-enable FirePHP
define('FIREPHP_ACTIVATED', true);

require_once('FirePHP/Init.php');

$console = FirePHP::to('page')->console();
if(isset($_GET['target'])) {    // set by the drop-down in the reference
    $console = FirePHP::to($_GET['target'])->console();
    if($_GET['target']=='request') {
        FirePHP::to('controller')->triggerInspect();
    }
}


// register a listener
class PayloadListener {
    public function onPayload($request, $payload) {
        echo($payload);
    }
}
Insight_Helper::getInstance()->registerListener('payload', new PayloadListener());


// send a test message
$console->log('Hello World'); 
