<?php

$firephp = FirePHP::getInstance(true);


$firephp->group('Group 1');
$firephp->fb('Test message 1');


$firephp->group('Group 2', array('Collapsed'=>false));
$firephp->fb('Test message 2');
$firephp->groupEnd();


$firephp->group('Collapsed Group', array('Collapsed'=>true));
$firephp->fb('Test message 2.1');
$firephp->groupEnd();

$firephp->group('Colored Collapsed Group', array('Collapsed'=>true, 'Color'=>'blue'));
$firephp->fb('Test message 2.2');
$firephp->groupEnd();

$firephp->group('Colored Group', array('Color'=>'#FF00FF'));
$firephp->fb('Test message 2.3');
$firephp->groupEnd();


$firephp->fb('Test message 3');
$firephp->groupEnd();
