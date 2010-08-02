<?php

$inspector = FirePHP::to("request"); 
 
$console = $inspector->console('Conditional');

$console->log('Message 1');

$console->on('Condition 1')->log('Condition 1 - Message 2');
$console->on('Condition 1')->log('Condition 1 - Message 3');

$console->on('Condition 2')->log('Condition 2 - Message 4');
$console->on('Condition 2')->log('Condition 2 - Message 5');

$console->on('Condition 2')->on('Condition 3')->log('Condition 3 - Message 6');
$console->on('Condition 2')->on('Condition 3')->log('Condition 3 - Message 7');

$console->on('Condition 4')->open();
    $console->log('Condition 4 - Message 8');
    $console->log('Condition 4 - Message 9');
    
    $console->on('Condition 5')->open();
        $console->group('Condition5')->log('Condition 5');
        $console->group('Condition5')->log('Message 10');
    $console->on('Condition 5')->close();
$console->on('Condition 4')->close();

$console->log('Message 11');
