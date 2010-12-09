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

