<?php

require_once('Insight/Program/JavaScript.php');

class FirePHP_Examples_PageControls1_Plugin extends Insight_Program_JavaScript {

    public function onMessage($message) {

        $data = $message->getData();

        if(is_array($data) && isset($data['action'])) {
            
            switch($data['action']) {
                case 'showPlugin':
                    FirePHP::to("plugin")->plugin('PageControls2')->show();
                    break;
                case 'removeAll':
                    FirePHP::to("plugin")->removeAll();
                    break;
            }

        } else {

            // relay message back to client
            $this->sendSimpleMessage($data);

        }
    }

}
