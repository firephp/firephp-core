<?php

$inspector = FirePHP::to("request"); 
 
 
$console1 = $inspector->console('Groups');
$console2 = $inspector->console('Messages');


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
