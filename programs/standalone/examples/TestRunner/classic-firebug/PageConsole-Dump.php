<?php

$firephp = FirePHP::getInstance(true);

$firephp->log("Hello World 1");

$firephp->fb("Hello World 2", "Key", FirePHP::DUMP);
