<?php

require_once('FirePHP/Insight/Dispatcher.php');

class FirePHP_Insight
{
    protected static $instance = null;
    
    private $dispatcher = null;


    public static function getInstance($AutoCreate=false) {
        if($AutoCreate===true && !self::$instance) {
            self::init();
        }
        return self::$instance;
    }

    public static function init() {
        return self::$instance = new self();
    }
    
    function __construct() {
        $this->dispatcher = new FireConsole_Dispatcher();
    }
    
    
    public function stop() {
        
        $this->dispatcher->send("Send STOP!!!");
        $this->dispatcher->getChannel()->flush();
        
    }
}
