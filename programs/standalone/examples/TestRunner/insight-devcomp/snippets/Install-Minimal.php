<?php

// NOTE: You must have FirePHP Companion installed (http://www.christophdorn.com/Tools/)

// See Firebug Console for result

define('INSIGHT_IPS', '*');
define('INSIGHT_AUTHKEYS', '*');
define('INSIGHT_PATHS', dirname(__FILE__));
define('INSIGHT_SERVER_PATH', './_insight_.php');
require_once('FirePHP/Init.php');


$inspector = FirePHP::to('page');
$console = $inspector->console();

$console->log('Hello World');
