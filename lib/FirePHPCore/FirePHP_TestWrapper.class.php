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

        preg_match('/(\d+)\|(.+)$/', $Value, $countMatch);

        $lengthBefore = strlen($Value);
        $this->_headers[$Name] = str_replace(str_replace('/', '\\/', getcwd()), '...', $Value);

        if ($countMatch) {

            $lengthAfter = strlen($this->_headers[$Name]);

            $this->_headers[$Name] = preg_replace(
                '/(\d+)\|(.+)$/',
                ($countMatch[1] - ($lengthBefore - $lengthAfter)) . '|$2',
                $this->_headers[$Name]
            );
        }
    }

    protected function headersSent(&$Filename, &$Linenum) {
        return false;
    }

    public function detectClientExtension() {
        return true;
    }
    
}
