<?php

set_include_path(get_include_path() . PATH_SEPARATOR . dirname(dirname(__FILE__)));

require_once('FirePHP/Insight.php');

FirePHP::setInstance(new FirePHP_Insight());

Insight_Helper__main();
