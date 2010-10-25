<?php

$firephp = FirePHP::getInstance(true);

$firephp->setOptions(array('includeLineNumbers'=>false));


$firephp->fb('Hello World'); /* Defaults to FirePHP::LOG */

$firephp->fb('Log message'  ,FirePHP::LOG);
$firephp->fb('Info message' ,FirePHP::INFO);
$firephp->fb('Warn message' ,FirePHP::WARN);
$firephp->fb('Error message',FirePHP::ERROR);

$firephp->fb(true);

$firephp->fb('Message with label','Label',FirePHP::LOG);

$firephp->fb(array('key1'=>'val1',
         'key2'=>array(array('v1','v2'),'v3')),
   'TestArray',FirePHP::LOG);

function test($Arg1) {
  throw new Exception('Test Exception');
}
try {
  test(array('Hello'=>'World'));
} catch(Exception $e) {
  /* Log exception including stack trace & variables */
  $firephp->fb($e);
}

$firephp->fb('Backtrace to here',FirePHP::TRACE);

$firephp->fb(array('2 SQL queries took 0.06 seconds',array(
   array('SQL Statement','Time','Result'),
   array('SELECT * FROM Foo','0.02',array('row1','row2')),
   array('SELECT * FROM Bar','0.04',array('row1','row2'))
  )),FirePHP::TABLE);

$firephp->fb(phpversion(), 'PHP Version', FirePHP::DUMP);
