<?php

class FirePHP_Plugin_FirePHP {
    
    public function trapProblems($console=false) {
        if(!$console) {
            $console = FirePHP::to('request')->console('Problems');
        }
        $engine = FirePHP::plugin('engine');
        $engine->onError($console);
        $engine->onAssertionError($console);
        $engine->onException($console);
    }

    public function recordEnvironment($console=false) {
        if(!$console) {
            $console = FirePHP::to('request')->console('Environment');
        }
        if(!$console->is(true)) {
            return false;
        }

        $console->label('PHP Version')->log(phpversion());
        $console->label('PHP Extensions')->log(get_loaded_extensions());
        
        $console->table('$_SERVER', $_SERVER);
        $console->table('$_COOKIE', $_COOKIE);
        $console->table('$_GET', $_GET);
        $console->table('$_POST', $_POST);
        $console->table('$_REQUEST', $_REQUEST);

        $console->label('get_include_path()')->log(get_include_path());
        $console->label('sys_get_temp_dir()')->log(sys_get_temp_dir());
        $console->label('php_ini_loaded_file()')->log(php_ini_loaded_file());
        $console->label('php_ini_scanned_files()')->log(php_ini_scanned_files());
        $console->label('php_sapi_name()')->log(php_sapi_name());
        $console->label('php_uname()')->log(php_uname());

        // TODO: Register a function to be called on shutdown to record included files

        return true;
    }
}
