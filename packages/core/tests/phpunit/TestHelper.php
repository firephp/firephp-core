<?php

/* NOTE: You must have the FirePHPCore library in your include path */
set_include_path(dirname(dirname(dirname(__FILE__))) . DIRECTORY_SEPARATOR . "lib" . PATH_SEPARATOR . get_include_path());

require('FirePHPCore/fb.php');

require_once('PHPUnit/Framework.php');

class FirePHP_Test_Class extends FirePHP {
    
    private $_headers = array();    


    public function _getHeaders() {
        return $this->_headers;
    }
    public function _clearHeaders() {
        $this->_headers = array();
    }


    // ######################
    // # Subclassed Methods #
    // ######################   

    protected function setHeader($Name, $Value) {
        $this->_headers[$Name] = $Value;
    }
    
    protected function headersSent(&$Filename, &$Linenum) {
        return false;
    }

    public function detectClientExtension() {
        return true;
    }
    
}
