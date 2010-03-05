<?php

function userErrorHandler($errno, $errmsg, $filename, $linenum, $vars)
{
	$firephp = FirePHP::getInstance(true);

	$dt = date( 'H:i:s D.m.Y');

	$errortype = array (
	E_ERROR              => 'Error',
	E_WARNING            => 'Warning',
	E_PARSE              => 'Parsing Error',
	E_NOTICE            => 'Notice',
	E_CORE_ERROR        => 'Core Error',
	E_CORE_WARNING      => 'Core Warning',
	E_COMPILE_ERROR      => 'Compile Error',
	E_COMPILE_WARNING    => 'Compile Warning',
	E_USER_ERROR        => 'User Error',
	E_USER_WARNING      => 'User Warning',
	E_USER_NOTICE        => 'User Notice',
	E_STRICT            => 'Runtime Notice'
	//E_RECOVERABLE_ERROR => 'Catchable Fatal Error'
	);

	$firephp->fb('Log message'  ,FirePHP::LOG);
	$firephp->fb('Info message' ,FirePHP::INFO);
	$firephp->fb('Warn message' ,FirePHP::WARN);
	$firephp->fb('Error message',FirePHP::ERROR);
	$firephp->fb('Backtrace to here', FirePHP::TRACE);

	$firephp->fb( sprintf( "%s: %s\n in %s on line %s", $errortype[$errno], $errmsg, $filename, $linenum ), FirePHP::TRACE );
	
}

$old_error_handler = set_error_handler("userErrorHandler");

date_default_timezone_set('America/Los_Angeles');

// Warning: Division by zero
echo 45/0;

