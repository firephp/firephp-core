<?php

$inspector = FirePHP::to("page"); 
 
$console = $inspector->console();

$console->log("This is a long informational string that should not be trimmed");
$console->info("This is a long informational string that should not be trimmed");
$console->warn("This is a long informational string that should not be trimmed");
$console->error("This is a long informational string that should not be trimmed");


$console->log(array("This is a long string that should be trimmed as it is not at the top level."));
