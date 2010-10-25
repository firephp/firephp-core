<?php

// See Firebug Console for result

require_once('_init_.php');

$inspector = FirePHP::to('page');
$console = $inspector->console();


$console->log('Ungrouped message 1');
$console->log('Ungrouped message 2');

$console->group('group1')->open();
    $console->log('Group 1');    // Group Label

    $console->log('Group 1 message 1');
    $console->info('Group 1 message 2');

    $group2 = $console->group('group2');
    $group2->log('Group 2');    // Group Label
    $group2->log('Group 2 message 1');
    
    $console->warn('Group 1 message 3');

$console->group('group1')->close();


$group3 = $console->group('group3');
    $group3->log('Group 3');    // Group Label
    $group3->log('Group 3 message 1');

$console->log('Ungrouped message 3');

    $group2->error('Group 2 message 2');
    $group3->trace('Group 3 message 2');


highlight_file(__FILE__);