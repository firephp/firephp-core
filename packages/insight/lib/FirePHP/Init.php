<?php

// Only activate FirePHP if certain header prefixes are found:
//  * x-wf-
//  * x-insight

$__FIREPHP__headers = false;
if(function_exists('getallheaders')) {
    $__FIREPHP__headers = getallheaders();
} else {
    $__FIREPHP__headers = $_SERVER;
}
$__FIREPHP__activate = false;
foreach( $__FIREPHP__headers as $name => $value ) {
    $name = strtolower($name);
    if(substr($name, 0, 5) == 'http_') {
        $name = str_replace(' ', '-', str_replace('_', ' ', substr($name, 5)));
    }
    if(substr($name, 0, 5)=='x-wf-') {
        $__FIREPHP__activate = true;
    } else
    if(substr($name, 0, 9)=='x-insight') {
        $__FIREPHP__activate = true;
    }
}
unset($__FIREPHP__headers);

if($__FIREPHP__activate) {

    unset($__FIREPHP__activate);

    set_include_path(get_include_path() . PATH_SEPARATOR . dirname(dirname(__FILE__)));
    
    require_once('FirePHP/Insight.php');
    
    FirePHP::setInstance(new FirePHP_Insight());
    
    Insight_Helper__main();

} else {

    unset($__FIREPHP__activate);

    class FirePHP {
        public function getEnabled() {
            return false;
        }
        public function detectClientExtension() {
            return false;
        }
        public function __call($name, $arguments) {
            return new FirePHP();
        }
        public static function __callStatic($name, $arguments) {
            return new FirePHP();
        }
    }

}
