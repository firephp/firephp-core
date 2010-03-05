<?php

$firephp = FirePHP::getInstance(true);

$firephp->registerErrorHandler();

ini_set('display_errors', '1');
ini_set('error_reporting', E_ALL);

$i = 0;
while(true) {

  try {
    switch($i) {
      case 0:
        trigger_error('This is a test E_USER_ERROR', E_USER_ERROR);
        break;
      case 1:
        @trigger_error('This is a test E_USER_ERROR', E_USER_ERROR);
        break;
      case 2:
        trigger_error('This is a test E_USER_NOTICE', E_USER_NOTICE);
        break;
      default:
        break 2;
    }
  } catch(Exception $e) {
    $firephp->fb($e);
  }
  
  $i++;
}

$firephp->registerExceptionHandler();

trigger_error('Final Error');
