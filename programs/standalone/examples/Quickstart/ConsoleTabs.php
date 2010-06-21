<?php

require_once('_init_.php');

FirePHP::to('controller')->triggerInspect();

$inspector = FirePHP::to('request');

$console = $inspector->console('First Tab');
$console->log('Hello World in first Tab');
$console->info('Info message');

$console = $inspector->console('Second Tab');
$console->log('Hello World in second Tab');
$console->warn('Warning message');
$console->label('Message Label')->error('Oh No!!');


highlight_file(__FILE__);