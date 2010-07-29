<?php

// NOTE: You must have FirePHP Companion installed (http://companion.firephp.org/)

// See FirePHP Companion for result

define('INSIGHT_CONFIG_PATH', dirname(dirname(dirname(__FILE__))) . DIRECTORY_SEPARATOR . 'package.json');
require_once('FirePHP/Init.php');
FirePHP::to('controller')->triggerInspect();


$inspector = FirePHP::to('request');
$console = $inspector->console('Tables');

$header = array('Column 1 Heading', 'Column 2 Heading');
$table = array(
    array('Row 1 Column 1 Value', 'Row 1 Column 2 Value'),
    array(10, true)
);
$console->table('Table without header', $table);
$console->table('Table with header', $table, $header);
