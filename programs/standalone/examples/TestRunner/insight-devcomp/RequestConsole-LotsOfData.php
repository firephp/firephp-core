<?php

$inspector = FirePHP::to("request"); 
 
$console = $inspector->console('Lot\'s of data');

$array = array();

for ( $i=0 ; $i<800 ; $i++ ) {
  $array[$i] = 'Element '.$i;
}

$console->log($array);
