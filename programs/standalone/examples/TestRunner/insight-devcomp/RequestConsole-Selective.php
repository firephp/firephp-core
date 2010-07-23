<?php

$inspector = FirePHP::to("request"); 
 
$console = $inspector->console('Selective');

$console->log('Message 1');

$console->on('Condition 1')->log('Message 2');
$console->on('Condition 1')->log('Message 3');

$console->on('Condition 2')->log('Message 4');

$console->log('Message 5');
