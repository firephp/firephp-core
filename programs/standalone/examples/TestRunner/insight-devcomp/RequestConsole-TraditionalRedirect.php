<?php

$firephp = FirePHP::getInstance(true);

$firephp->setLogToInsightConsole('Firebug');

$firephp->log('Log message');
$firephp->log('Log message', 'Label');

$firephp->info('Info message');
$firephp->warn('Warn message');
$firephp->error('Error message');

$firephp->dump('key', 'value');

$firephp->trace('Trace to here');

try {
    throw new Exception('Test exception');
} catch(Exception $e) {
    $firephp->fb($e, FirePHP::EXCEPTION);
}

$firephp->fb(array('2 SQL queries took 0.06 seconds',array(
   array('SQL Statement','Time','Result'),
   array('SELECT * FROM Foo','0.02',array('row1','row2')),
   array('SELECT * FROM Bar','0.04',array('row1','row2'))
  )), FirePHP::TABLE);

$firephp->table('2 SQL queries took 0.06 seconds',array(
   array('SQL Statement','Time','Result'),
   array('SELECT * FROM Foo','0.02',array('row1','row2')),
   array('SELECT * FROM Bar','0.04',array('row1','row2'))
  ));


$firephp->group('Group 1');
$firephp->fb('Test message 1');

$firephp->group('Group 2');
$firephp->fb('Test message 2');
$firephp->groupEnd();

$firephp->fb('Test message 3');
$firephp->groupEnd();

