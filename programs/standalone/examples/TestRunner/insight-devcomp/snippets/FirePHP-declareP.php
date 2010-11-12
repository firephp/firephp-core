<?php

// NOTE: You must have FirePHP Companion installed (http://www.christophdorn.com/Tools/)

// See FirePHP Companion and Firebug Console for result

define('INSIGHT_CONFIG_PATH', dirname(dirname(dirname(__FILE__))) . DIRECTORY_SEPARATOR . 'package.json');
require_once('FirePHP/Init.php');


$firephp = FirePHP::plugin("firephp");


$firephp->declareP();

p('Hey there Firebug Console', 'Variable Label');


$firephp->declareP('Ad-hock', true);

p('Hey there Ad-hock Console', 'Variable Label');


$console = FirePHP::to('request')->console('Debug');
$firephp->declareP($console, true);

p('Hey there Debug Console', 'Variable Label');
