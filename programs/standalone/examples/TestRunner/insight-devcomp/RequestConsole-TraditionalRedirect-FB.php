<?php

require_once('FirePHP/fb.php');

FB::setLogToInsightConsole('Firebug');

fb('Log message');


FB::log('Log message');
FB::log('Log message', 'Label');

FB::info('Info message');
FB::warn('Warn message');
FB::error('Error message');

FB::dump('key', 'value');

FB::trace('Trace to here');

try {
    throw new Exception('Test exception');
} catch(Exception $e) {
    FB::error($e);
}

FB::table('2 SQL queries took 0.06 seconds',array(
   array('SQL Statement','Time','Result'),
   array('SELECT * FROM Foo','0.02',array('row1','row2')),
   array('SELECT * FROM Bar','0.04',array('row1','row2'))
  ));


FB::group('Group 1');
FB::log('Test message 1');

FB::group('Group 2');
FB::log('Test message 2');
FB::groupEnd();

FB::log('Test message 3');
FB::groupEnd();
