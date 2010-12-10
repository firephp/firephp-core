<?php

/* NOTE: You must have the FirePHP library on your include path */
$libPath = dirname(dirname(dirname($_SERVER['SCRIPT_FILENAME']))) . DIRECTORY_SEPARATOR . "lib";

$includePath = explode(PATH_SEPARATOR, get_include_path());
if(!in_array($libPath, $includePath)) {
    array_unshift($includePath, $libPath);
    set_include_path(implode(PATH_SEPARATOR, $includePath));
}

$available = false;
$PINF_HOME = isset($_SERVER['PINF_HOME']) ? $_SERVER['PINF_HOME'] : '/pinf';
if(is_dir($PINF_HOME)) {
    $path = $PINF_HOME . '/workspaces/github.com/firephp/ui-plugins';
    if(!is_dir($path)) {
        // HACK
        $path = '/pinf/programs/com.developercompanion.reference/packages/firephp-ui-plugins';
    }
    if(is_dir($path)) {
        $available = true;
    }
}

if(!$available) {
    throw new Exception("firephp/ui-plugins project not installed!");
}

$GLOBALS['INSIGHT_ADDITIONAL_CONFIG'] = array(
    'implements' => array(
        'cadorn.org/insight/@meta/config/0' => array(
            'paths' => array(
                realpath($path) => 'allow'
            )
        )
    )
);

define('INSIGHT_CONFIG_PATH', dirname(__FILE__) . DIRECTORY_SEPARATOR . 'package.json');
require_once('FirePHP/Init.php');
