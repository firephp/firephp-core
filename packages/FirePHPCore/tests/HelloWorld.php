<?php

/* NOTE: You must have the FirePHPCore library in your include path */

set_include_path('./../lib/'.PATH_SEPARATOR.get_include_path());
 

require('FirePHPCore/fb.php');


FB::log('Hello Log');
FB::info('Hello Info');
FB::warn('Hello Warn');
FB::error('Hello Error');


FB::group('Group 1');

    FB::log('Hello Log 1');
    FB::log('Hello Log 11');

    FB::group('Group 2');

        FB::log('Hello Log 2');
        FB::warn('Hello Log 22');
    
    FB::groupEnd();

    FB::log('Hello Log 3');
    FB::info('Hello Log 33');

FB::groupEnd();

FB::log('Hello Log 4');
FB::log('Hello Log 44');


FB::group('Group 1');

    FB::log('Hello Log 1');
    FB::log('Hello Log 11');

