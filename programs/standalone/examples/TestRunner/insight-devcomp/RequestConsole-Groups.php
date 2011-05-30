<?php

$inspector = FirePHP::to("request"); 
 
 
$console2 = $inspector->console('Messages');
$console2->log('Message');

$console1 = $inspector->console('Groups');
$console1->show();

$group = $console1->group('Group1')->open();

$console1->log('Group Title');
$console1->log('Message 1');
$console1->log('Message 2');

$console2->log('Message 3');

$group->close();



$group = $console1->expand()->group('Group2', 'Group 2 Title')->open();

$console1->log('Message 1');
$console1->log('Message 2');

$group->close();



$group = $console1->expand()->group('Group3', 'Group 3 Title')->open();

$console1->log('Message 1');

$group->close();


$group = $console1->expand()->group('Group4', 'Group 4 Title')->open();

$console1->log('Message 1');
    
    $group = $console1->group('Group41')->open();
    
    $console1->log('Group Title');
    $console1->log('Message 1');
    $console1->log('Message 2');
    
    $console2->log('Message 3');
    
    $group->close();

$group->close();

$group = $console1->expand()->group('Group5', 'Group 5 Title')->open();

$group->close();
