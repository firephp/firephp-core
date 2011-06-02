<?php

trigger_error("Test error");

$var = false;
assert('$var===true');


// this triggers an E_NOTICE
$array = array();
$var1 = $array['test'];


//throw new Exception('Test Exception');
