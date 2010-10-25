<?php

FB::group('Test Group');

FB::send('Hello World');

FB::groupEnd();


FB::log('Log Message');

FB::info('Info Message');

FB::warn('Info Message');

FB::error('Info Message');

FB::trace('Trace to here');
FB::send('Trace to here', FirePHP::TRACE);

FB::table('2 SQL queries took 0.06 seconds',
  array(
   array('SQL Statement','Time','Result'),
   array('SELECT * FROM Foo','0.02',array('row1','row2')),
   array('SELECT * FROM Bar','0.04',array('row1','row2'))
  ));

FB::dump('PHP Version', phpversion());
