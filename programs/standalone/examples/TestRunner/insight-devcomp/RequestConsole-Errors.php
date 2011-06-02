<?php

/*
NOTE: The error messages will automatically show up in the request context if workspace is selected
$console = FirePHP::to('request')->console('Errors');
FirePHP::plugin('error')->onError($console);
FirePHP::plugin('error')->onException($console);
FirePHP::plugin('assertion')->onAssertionError($console);
$console->show();
*/

trigger_error("Test error");

$var = false;
assert('$var===true');


// this triggers an E_NOTICE
$array = array();
$var1 = $array['test'];


//throw new Exception('Test Exception');
