<?php

$inspector = FirePHP::to("page"); 
 
$console = $inspector->console();


$console->log(array('blah<blah>blah' => '<something>')); 

$console->log("8791|Harive\n1ZE08154|Ink\n13466955|Pter\n05358|TV"); 

$console->log("8791|Harive\n1ZE08154|Ink\n13466955|Pter\n05358|TV8791|Harive\n1ZE08154|Ink\n13466955|Pter\n05358|TV8791|Harive\n1ZE08154|Ink\n13466955|Pter\n05358|TV8791|Harive\n1ZE08154|Ink\n13466955|Pter\n05358|TV8791|Harive\n1ZE08154|Ink\n13466955|Pter\n05358|TV"); 

$console->log(array("string with newlines" => "8791|Harive\n1ZE08154|Ink\n13466955|Pter\n05358|TV"));

for($i=0;$i<3;$i++){
   $console->label($i)->log('hello');
}


$console->log(array('§foo'=>'§foo')); 
$console->log(array('¤foo'=>'¤foo')); 
$console->log(array('£foo'=>'£foo')); 
$console->log(array('€foo'=>'€foo')); 
$console->log(array('§a¤b£c€'=>'§a¤b£c€')); 


$console->log(array('foo'=>'bar'));
$console->log(array('foo'=>'bár'));
$console->label('fóó')->log(array('fóó'=>'bar'));


$console->label("num tel")->log("muméro de téléphone");
$console->label("num tel")->log(array('numéro'=>123));


$console->label("Special chars")->log("%ù*$=)^:!");


$array = array(
    null => null,
    'na MŠ DU' => 'ana MŠ DU',
    'ana MÁŠ DU' => 'ana MÁŠ DU',
    '&#251;' => '&#251;',
    chr(251) => chr(251)
);
$console->log($array);


class testClass {}
$obj = new testClass();
$obj->null = null;

$console->log($obj);


trigger_error("Test Error");
