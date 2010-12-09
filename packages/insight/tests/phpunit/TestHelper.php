<?php

// If firephp/ui-plugins are available
$PINF_HOME = getenv('PINF_HOME') ? getenv('PINF_HOME') : '/pinf';
$INSIGHT_HOME = $PINF_HOME . '/builds/registry.pinf.org/cadorn.org/github/firephp-libs/programs/standalone/master/standalone/linked/lib';
if(is_dir($INSIGHT_HOME)) {
    set_include_path($INSIGHT_HOME . PATH_SEPARATOR . get_include_path());
}

define('FIREPHP_ACTIVATED', true);
require('FirePHP/Init.php');

require_once('PHPUnit/Framework.php');
