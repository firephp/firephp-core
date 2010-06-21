<?php

$inspector = FirePHP::to("request"); 
 
$console = $inspector->console('Messages');

$console->log("Hello World from automatic inspect");

FirePHP::to('controller')->triggerInspect();
