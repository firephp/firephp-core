<?php

$inspector = FirePHP::to("request"); 
 
$console = $inspector->console('Messages');

$console->log("Hello World from manual inspect");

$console->label('Time')->log(time());

header('x-insight: inspect');
