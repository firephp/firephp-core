<?php

class FirePHP_Plugin_Engine {
    
    protected $traceOffset = 6;

    protected $errorConsole = null;
    protected $errorTypes = null;
    protected $assertionErrorConsole = null;
    protected $exceptionConsole = null;
    protected $inExceptionHandler = false;


    /**
     * Capture all errors and send to provided console
     * 
     * @return mixed Returns a string containing the previously defined error handler (if any)
     */
    public function onError($console, $types = E_ALL) {

        $this->errorConsole = $console;
        $this->errorTypes = $types;

        //NOTE: The following errors will not be caught by this error handler:
        //      E_ERROR, E_PARSE, E_CORE_ERROR,
        //      E_CORE_WARNING, E_COMPILE_ERROR,
        //      E_COMPILE_WARNING, E_STRICT
        return set_error_handler(array($this,'_errorHandler'));     
    }

    public function _errorHandler($errno, $errstr, $errfile, $errline, $errcontext) {
        if(!$this->errorConsole) {
            return;
        }
        // ignore assertion errors if being caught separately
        if(substr($errstr, 0, 8)=='assert()' && preg_match_all('/^assert\(\) \[<a href=\'function.assert\'>function.assert<\/a>\]: Assertion (.*) failed$/si', $errstr, $m)) {
            if($this->assertionErrorConsole) {
                return;
            }
        }
        // Only log errors we are asking for
        if ($this->errorTypes & $errno) {
            $this->errorConsole->setTemporaryTraceOffset($this->traceOffset);
            $this->errorConsole->meta(array(
                'encoder.depthExtend' => 5,
                'encoder.exception.traceOffset' => 1
            ))->error(new ErrorException($errstr, 0, $errno, $errfile, $errline));
        }
    }

    /**
     * Capture all assertion errors and send to provided console
     * 
     * @return mixed Returns the original setting or FALSE on error
     */
    public function onAssertionError($console) {
        $this->assertionErrorConsole = $console;
        return assert_options(ASSERT_CALLBACK, array($this, '_assertionErrorHandler'));
    }

    public function _assertionErrorHandler($file, $line, $code) {
        if(!$this->assertionErrorConsole) {
            return;
        }
        $this->assertionErrorConsole->setTemporaryTraceOffset($this->traceOffset);
        $this->assertionErrorConsole->meta(array(
            'encoder.depthExtend' => 5,
            'encoder.exception.traceOffset' => 1
        ))->error(new ErrorException('Assertion Failed - Code[ '.$code.' ]', 0, null, $file, $line));
    }
   

    /**
     * Capture exceptions and send to provided console
     * 
     * @return mixed Returns the name of the previously defined exception handler,
     *               or NULL on error.
     *               If no previous handler was defined, NULL is also returned.
     */   
    public function onException($console) {
        $this->exceptionConsole = $console;
        return set_exception_handler(array($this,'_exceptionHandler'));     
    }

    function _exceptionHandler($exception) {
        if(!$this->exceptionConsole) {
            return;
        }

        // TODO: Test this
        if($this->inExceptionHandler===true) {
            trigger_error('Error sending exception');
        }
        
        $this->inExceptionHandler = true;

        // NOTE: This produces some junk in the output. Looks like a bug in PHP?
        header('HTTP/1.1 500 Internal Server Error');
        header('Status: 500');

        try {
            $this->exceptionConsole->setTemporaryTraceOffset(-1);
            $this->exceptionConsole->meta(array(
                'encoder.depthExtend' => 5,
                'encoder.exception.traceOffset' => -1
            ))->error($exception);
        } catch(Exception $e) {
            trigger_error('Error sending exception: ' + $e);
        }
        $this->inExceptionHandler = false;
    }

    public function handleException($exception, $console=null) {
        if(!$console) {
            $console = $this->exceptionConsole;
        }
        if(!$console) {
            trigger_error('No exception console set for engine. See onException().');
            return;
        }
        $console->setTemporaryTraceOffset(-1);
        $console->meta(array(
            'encoder.depthExtend' => 5,
            'encoder.exception.traceOffset' => -1
        ))->error($exception);
    }
}
