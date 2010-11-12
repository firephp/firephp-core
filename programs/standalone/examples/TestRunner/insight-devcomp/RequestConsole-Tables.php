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


$data = array(
    'key1' => 'value1',
    'key2' => 'value2'
);

$table = array();
foreach ($data as $key=>$value) {
    $table[] = array($key, $value);
}
$console->table('Table Title 1', $table, array('Key', 'Value'));


$data = array(
    'value1',
    'value2'
);

$table = array();
foreach ($data as $key=>$value) {
    $table[] = array($key, $value);
}
$console->table('Table Title 2', $table, array('Key', 'Value'));
