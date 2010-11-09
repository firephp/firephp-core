<?php

// NOTE: You must have FirePHP Companion installed (http://www.christophdorn.com/Tools/)

// See the Firebug Console for result

require_once('FirePHPCore/FirePHP.class.php');

$firephp = FirePHP::getInstance(true);
$firephp->log('Hello World');
