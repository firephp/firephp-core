<?php

class FirePHP_TestWrapper extends FirePHP {
    
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
