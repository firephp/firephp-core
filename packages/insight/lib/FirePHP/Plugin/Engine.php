<?php

if(!defined('E_USER_DEPRECATED ')) {
    define('E_USER_DEPRECATED ', 16384);
}

class FirePHP_Plugin_Engine {
    
    public function onError($console, $types = E_ALL) {
        trigger_error('FirePHP_Plugin_Engine::onError() is DEPRECATED! This functionality is now available via Insight_Plugin_Error and enabled by default. You can remove this call.', E_USER_DEPRECATED);
    }

    public function _errorHandler($errno, $errstr, $errfile, $errline, $errcontext) {
        trigger_error('FirePHP_Plugin_Engine::_errorHandler() is DEPRECATED! This functionality is now available via Insight_Plugin_Error and enabled by default. You can remove this call.', E_USER_DEPRECATED);
    }

    public function onAssertionError($console) {
        trigger_error('FirePHP_Plugin_Engine::onAssertionError() is DEPRECATED! This functionality is now available via Insight_Plugin_Assertion and enabled by default. You can remove this call.', E_USER_DEPRECATED);
    }

    public function _assertionErrorHandler($file, $line, $code) {
        trigger_error('FirePHP_Plugin_Engine::_assertionErrorHandler() is DEPRECATED! This functionality is now available via Insight_Plugin_Assertion and enabled by default. You can remove this call.', E_USER_DEPRECATED);
    }
   
    public function onException($console) {
        trigger_error('FirePHP_Plugin_Engine::onException() is DEPRECATED! This functionality is now available via Insight_Plugin_Error and enabled by default. You can remove this call.', E_USER_DEPRECATED);
    }

    function _exceptionHandler($exception) {
        trigger_error('FirePHP_Plugin_Engine::_exceptionHandler() is DEPRECATED! This functionality is now available via Insight_Plugin_Error and enabled by default. You can remove this call.', E_USER_DEPRECATED);
    }

    public function handleException($exception, $console=null) {
        trigger_error('FirePHP_Plugin_Engine::handleException() is DEPRECATED! Use [Console API]->error() instead.', E_USER_DEPRECATED);
    }
    
    public function logException($exception) {
        trigger_error('FirePHP_Plugin_Engine::logException() is DEPRECATED! This functionality is now available via Insight_Plugin_Error and enabled by default. You can remove this call.', E_USER_DEPRECATED);
    }

    public static function parseErrorReportingBitmask($bitmask) {
        trigger_error('FirePHP_Plugin_Engine::parseErrorReportingBitmask() is DEPRECATED! This functionality is now available via Insight_Plugin_Error and enabled by default. You can remove this call.', E_USER_DEPRECATED);
    }

    public function errorLabelForNumber($number) {
        trigger_error('FirePHP_Plugin_Engine::errorLabelForNumber() is DEPRECATED! This functionality is now available via Insight_Plugin_Error and enabled by default. You can remove this call.', E_USER_DEPRECATED);
    }    
}
