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

}
