<?php

class FirePHP_TestWrapper extends FirePHP {

    private $_headers = array();


    public function _getHeaders() {
        return $this->_headers;
    }
    public function _getHeader($index) {
        return $this->_headers[array_slice(array_keys($this->_headers), $index-1, 1)[0]];
    }
    public function _clearHeaders() {
        $this->_headers = array();
    }


    // ######################
    // # Subclassed Methods #
    // ######################   

    protected function setHeader($Name, $Value) {
        $this->_headers[$Name] = str_replace(str_replace('/', '\\/', getcwd()), '...', $Value);
    }

    protected function headersSent(&$Filename, &$Linenum) {
        return false;
    }

    public function detectClientExtension() {
        return true;
    }
    
}
