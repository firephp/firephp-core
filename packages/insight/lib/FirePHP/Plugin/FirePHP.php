<?php

require_once('FirePHP/Plugin/Engine.php');

class FirePHP_Plugin_FirePHP {
    
    public function trapProblems($console=false) {
        if(!$console) {
            $console = FirePHP::to('page')->console('Problems');
        }
        $engine = FirePHP::plugin('engine');
        $engine->onError($console);
        $engine->onAssertionError($console);
        $engine->onException($console);
    }

    public function recordEnvironment($console=false) {
        if(!$console) {
            $console = FirePHP::to('page')->console('Environment');
        }
        if(!$console->is(true)) {
            return false;
        }

        $console = $console->nolimit();

        $console->label('PHP Version')->log(phpversion());
        $console->label('PHP Extensions')->log(get_loaded_extensions());
        
        $console->table('$_GET', isset($_GET)?$_GET:false);
        $console->table('$_POST', isset($_POST)?$_POST:false);
        $console->table('$_REQUEST', isset($_REQUEST)?$_REQUEST:false);
        $console->table('$_COOKIE', isset($_COOKIE)?$_COOKIE:false);
        $console->table('$_FILES', isset($_FILES)?$_FILES:false);
        $console->table('$_SERVER', isset($_SERVER)?$_SERVER:false);
        $console->table('$_ENV', isset($_ENV)?$_ENV:false);

        $console->table('$HTTP_GET_VARS', isset($HTTP_GET_VARS)?$HTTP_GET_VARS:false);
        $console->table('$HTTP_POST_VARS', isset($HTTP_POST_VARS)?$HTTP_POST_VARS:false);
        $console->table('$HTTP_COOKIE_VARS', isset($HTTP_COOKIE_VARS)?$HTTP_COOKIE_VARS:false);
        $console->table('$HTTP_SERVER_VARS', isset($HTTP_SERVER_VARS)?$HTTP_SERVER_VARS:false);
        $console->table('$HTTP_ENV_VARS', isset($HTTP_ENV_VARS)?$HTTP_ENV_VARS:false);

        $group = $console->nolimit(false)->group();
        $group->log('$GLOBALS');
        foreach( $GLOBALS as $key => $value ) {
            switch($key) {
                case 'GLOBALS':
                case '_ENV':
                case 'HTTP_ENV_VARS':
                case '_POST':
                case 'HTTP_POST_VARS':
                case '_GET':
                case 'HTTP_GET_VARS':
                case '_COOKIE':
                case 'HTTP_COOKIE_VARS':
                case '_SERVER':
                case 'HTTP_SERVER_VARS':
                case '_FILES':
                case 'HTTP_POST_FILES':
                case '_REQUEST':
                	// skip
                    break;
                default:
                    $group->label($key)->log($value);
                    break;
            }
        }
        
        $table = array();
        foreach( ini_get_all() as $name => $info ) {
            $row = array($name, $info['global_value'], $info['local_value'], array());
            if($info['access'] & INI_ALL) {
                $row[3][] = 'All';
            } else {
                if($info['access'] & INI_USER) {
                    $row[3][] = 'User';
                } 
                if($info['access'] & INI_PERDIR) {
                    $row[3][] = 'Perdir';
                } 
                if($info['access'] & INI_SYSTEM) {
                    $row[3][] = 'System';
                }
            }
            $row[3] = implode(', ', $row[3]);
            $table[] = $row;
        }
        $console->table('Configuration Options', $table, array('Name', 'Global', 'Local', 'Access'));

        $console->label('Error Reporting')->log(FirePHP_Plugin_Engine::parseErrorReportingBitmask(error_reporting()));

        $console->label('get_include_path()')->log(get_include_path());
        if(function_exists('sys_get_temp_dir')) {
            $console->label('sys_get_temp_dir()')->log(sys_get_temp_dir());
        }
        if(function_exists('php_ini_loaded_file')) {
            $console->label('php_ini_loaded_file()')->log(php_ini_loaded_file());
        }
        $console->label('php_ini_scanned_files()')->log(php_ini_scanned_files());
        $console->label('php_sapi_name()')->log(php_sapi_name());
        $console->label('php_uname()')->log(php_uname());

        // TODO: Register a function to be called on shutdown to record included files

        return true;
    }
}
