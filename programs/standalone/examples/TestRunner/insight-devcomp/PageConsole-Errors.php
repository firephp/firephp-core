<?php

trigger_error("Test error");

$var = false;
assert('$var===true');

throw new Exception('Test Exception');
