<?php

$firephp = FirePHP::getInstance(true);

$firephp->log("This is a long informational string that should not be trimmed");
$firephp->info("This is a long informational string that should not be trimmed");
$firephp->warn("This is a long informational string that should not be trimmed");
$firephp->error("This is a long informational string that should not be trimmed");


$firephp->log(array("This is a long string that should be trimmed as it is not at the top level."));
