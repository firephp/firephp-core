<?php

function __autoload__($class)
{
    if (strpos($class, 'FirePHPCore') !== 0 && $class != 'FirePHP') {
        return;
    }

    $basePath = dirname(dirname(__FILE__)) . '/lib';
    if (!file_exists($basePath)) {
        $basePath = dirname(dirname(dirname(dirname(__FILE__)))) . '/lib';
    }
    
    if ($class == 'FirePHP') {
        $class = 'FirePHPCore/FirePHP.class';
    }

    // find relative
    if (file_exists($file = $basePath . '/' . str_replace('_', '/', $class) . '.php')) {
        require_once($file);
    }
}

spl_autoload_register('__autoload__');

class FirePHP_Test_Class extends FirePHP {
    
    // ######################
    // # Subclassed Methods #
    // ######################   

    protected function sendHeader($header) {
        // Do nothing for testing
    }
    
    protected function headersSent(&$Filename, &$Linenum) {
        return false;
    }

    public function detectClientExtension() {
        return true;
    }
    
}
