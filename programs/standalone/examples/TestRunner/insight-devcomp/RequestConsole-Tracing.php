<?php

$inspector = FirePHP::to("request"); 
 
$console = $inspector->console('Tracing');

function testTrace2($console) {
    $console->trace('Trace to here');
}
function testTrace1($console, $inspector) {
    testTrace2($console);
}
testTrace1($console, $inspector);
