<?php

$inspector = FirePHP::to("request"); 
 
$console = $inspector->console('Tables');


$vars =  array();

for( $i=0 ; $i < 30 ; $i++ ) {
    $vars['Key ' . $i] = 'Value ' . $i;
}

$console->table('Long Table 1', $vars, array('Variable', 'Value'));


$console = $console->option('encoder.maxArrayLength', -1);

$console->table('Long Table 2', $vars, array('Variable', 'Value'));
