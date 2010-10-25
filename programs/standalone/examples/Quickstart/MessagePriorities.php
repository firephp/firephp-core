<?php

// See Firebug Console for result

require_once('_init_.php');

$inspector = FirePHP::to('page');
$console = $inspector->console();


$console->log('Log Message');
$console->info('Info message');
$console->warn('Warning message');
$console->error('Error message');


highlight_file(__FILE__);