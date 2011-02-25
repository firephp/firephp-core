<?php

$firephp = FirePHP::getInstance(true);

$firephp->fb("Отладочный");


$firephp->fb(array('characters'=>"Отладочный"));


$firephp->fb("Отладочный", 'var1', FirePHP::DUMP);
$firephp->fb(array('characters'=>"Отладочный"), 'var2', FirePHP::DUMP);


$firephp->fb("mon numéro est le 0");


$firephp->setOptions(array('useNativeJsonEncode'=>false));

$firephp->fb("Отладочный");


$firephp->fb(array('characters'=>"Отладочный"));


$firephp->fb("Отладочный", 'var1', FirePHP::DUMP);
$firephp->fb(array('characters'=>"Отладочный"), 'var2', FirePHP::DUMP);


$firephp->fb("mon numéro est le 0");

// See: http://code.google.com/p/firephp/issues/detail?id=153
$firephp->fb('アサヒ スーパードライ');


FB::log(array('foo'=>'bar'));
FB::log(array('foo'=>'bár'));
FB::log(array('fóó'=>'bar'));


fb("muméro de téléphone","num tel");

fb(array('numéro'=>123),"num tel");
