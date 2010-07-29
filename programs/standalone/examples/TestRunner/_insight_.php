<?php

/* NOTE: You must have the FirePHP library on your include path */
$libPath = dirname(dirname(dirname($_SERVER['SCRIPT_FILENAME']))) . DIRECTORY_SEPARATOR . "lib";

$includePath = explode(PATH_SEPARATOR, get_include_path());
if(!in_array($libPath, $includePath)) {
    array_unshift($includePath, $libPath);
    set_include_path(implode(PATH_SEPARATOR, $includePath));
}

require_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'insight-devcomp' . DIRECTORY_SEPARATOR . '_init_.php');
