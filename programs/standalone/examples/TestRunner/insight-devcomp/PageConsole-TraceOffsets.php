<?php

$logger = new Logger();

$logger->log('Hello World');
$logger->trace('Trace to here');
$logger->logCustomLine('Hello World (custom line)', 3);

try {
    throw new Exception("Test Exception");
} catch(Exception $e) {
    $logger->handleException($e);    
}

class Logger {

    private $console;
    private $engine;

    function __construct() {
        $this->console = FirePHP::to("page")->console();
        $this->console = $this->console->options(array(
            'encoder.trace.offsetAdjustment' => 1
        ));
        $this->engine = FirePHP::plugin('engine');
        $this->engine->onException($this->console);
    }

    function log($msg) {
        $this->console->log($msg);
    }
    
    function logCustomLine($msg, $line) {
        $this->console->options(array(
            'line' => $line
        ))->log($msg);
    }

    function trace($title) {
        $this->console->trace($title);
    }

    function handleException($e) {
        $this->engine->handleException($e);
    }
}
