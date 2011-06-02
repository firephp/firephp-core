<?php

// This function is called at the bottom of this file
function FirePHP__main() {

    $activate = true;
    $force = false;

    if(defined('FIREPHP_ACTIVATED')) {
        if(constant('FIREPHP_ACTIVATED')===false) {
            $activate = false;
        } else
        if(constant('FIREPHP_ACTIVATED')===true) {
            $activate = true;
            $force = true;
        }
    }

    if($activate && $force===false) {

        // Only activate FirePHP if certain header prefixes are found:
        //  * x-wf-
        //  * x-insight
        
        $headers = false;
        if(function_exists('getallheaders')) {
            $headers = getallheaders();
        } else {
            $headers = $_SERVER;
        }
        $activate = false;
        foreach( $headers as $name => $value ) {
            $name = strtolower($name);
            if(substr($name, 0, 5) == 'http_') {
                $name = str_replace(' ', '-', str_replace('_', ' ', substr($name, 5)));
            }
            if(substr($name, 0, 5)=='x-wf-') {
                $activate = true;
            } else
            if(substr($name, 0, 9)=='x-insight') {
                $activate = true;
            }
        }
    }

    if($activate) {

        if(!defined('FIREPHP_ACTIVATED')) {
            define('FIREPHP_ACTIVATED', true);
        }

        // TODO: This may be removed in future?
        set_include_path(get_include_path() . PATH_SEPARATOR . dirname(dirname(__FILE__)));

        spl_autoload_register('FirePHP__autoload');

        if (class_exists('FirePHP', false)) {
            throw new Exception("The FirePHP class must not be loaded manually!");
        }

        // NOTE: We need to load this class here so we can get access to the FirePHP class
        FirePHP__autoload('FirePHP_Insight');

        // ensure the FirePHP class included has the correct version
        $version = '0.3';    // @pinf replace '0.3' with '%%package.version%%'
        if(FirePHP::VERSION!=$version) {
            throw new Exception("The included FirePHP class has the wrong version! This is likely due to an old version of FirePHP still being on the include path. The old version must be removed or the FirePHP 1.0 classes must have precedence on the include path!");
        }

        FirePHP::setInstance(new FirePHP_Insight());

        if($force===true) {
            $GLOBALS['INSIGHT_FORCE_ENABLE'] = true;
        }

        Insight_Helper__main();

        FirePHP::getInstance(true)->setLogToInsightConsole(FirePHP::to('page')->console());

    } else {

        if(!defined('FIREPHP_ACTIVATED')) {
            define('FIREPHP_ACTIVATED', false);
        }

        class FirePHP {
            const VERSION = '0.3';    // @pinf replace '0.3' with '%%package.version%%'
            const LOG = 'LOG';
            const INFO = 'INFO';
            const WARN = 'WARN';
            const ERROR = 'ERROR';
            const DUMP = 'DUMP';
            const TRACE = 'TRACE';
            const EXCEPTION = 'EXCEPTION';
            const TABLE = 'TABLE';
            const GROUP_START = 'GROUP_START';
            const GROUP_END = 'GROUP_END';
            protected static $instance = null;
            public static function getInstance() {
                if(!self::$instance) {
                    self::$instance = new FirePHP();
                }
                return self::$instance;
            }
            public function getEnabled() {
                return false;
            }
            public function detectClientExtension() {
                return false;
            }
            public static function to() {
                return self::getInstance();
            }
            public static function plugin() {
                return self::getInstance();
            }
            public function __call($name, $arguments) {
                return self::getInstance();
            }
            public static function __callStatic($name, $arguments) {
                return self::getInstance();
            }
        }
    }
}

function FirePHP__autoload($class)
{
    if (strpos($class, 'FirePHP') !== 0 &&
        strpos($class, 'Insight') !== 0
    ) {
        return;
    }

    // find relative
    if (file_exists($file = dirname(dirname(__FILE__)) . '/' . str_replace('_', '/', $class) . '.php')) {
        require_once($file);
    } else
    // find in include path
    {
        foreach (explode(PATH_SEPARATOR, get_include_path()) as $basePath) {
            if (file_exists($file = $basePath . '/' . str_replace('_', '/', $class) . '.php')) {
                require_once($file);
                return;
            }
        }
    }
}

FirePHP__main();
