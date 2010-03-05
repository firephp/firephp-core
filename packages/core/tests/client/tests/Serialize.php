<?php

$firephp = FirePHP::getInstance(true);

$firephp->setOptions(array('includeLineNumbers'=>false,'maxArrayDepth'=>4));
$firephp->setObjectFilter('TestObject2',array('name2','name3'));

$firephp->setEnabled(false);

$serialized = serialize($firephp);

$firephp->setEnabled(true);

fb(array('String'=>$serialized), 'Serialized FirePHP Object');

$obj = unserialize($serialized);

echo '<pre>';
var_dump($obj);
echo '</pre>';
