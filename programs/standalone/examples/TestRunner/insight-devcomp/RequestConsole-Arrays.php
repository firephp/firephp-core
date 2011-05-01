<?php

$inspector = FirePHP::to("request"); 
 
$console = $inspector->console('Arrays');

$test = array(123,234);
$console->log($test);

$test = array('123',234,"567");
$console->log($test);

$test = array('123'=>234, 234, "567");
$console->expand()->log($test);

$test = array('a123'=>234, 234, "567");
$console->log($test);

$test = array(123,234);
$console->table('test 0', $test);

$test = array(array(123,234));
$console->table('test 1', $test);

$test = array(array(array(123,234)));
$console->table('test 2',$test);

$test = array(123 => 123,234 => 234);
$console->table('test 3',$test);

$test = array(array(123 => 123,234 => 234));
$console->table('test 4',$test);

$test = array(array(array(123 => 123,234 => 234)));
$console->table('test 5',$test);

$test = array('123','234');
$console->table('test 6',$test);

$test = array(array('123','234'));
$console->table('test 7',$test);

$test = array(array(array('123','234')));
$console->table('test 8',$test);

$test = array('123' => '123','234' => '234');
$console->table('test 9',$test);

$test = array(array('123' => '123','234' => '234'));
$console->table('test 10',$test);

$test = array(array(array('123' => '123','234' => '234')));
$console->table('test 11',$test);

FirePHP::to('controller')->triggerInspect();
