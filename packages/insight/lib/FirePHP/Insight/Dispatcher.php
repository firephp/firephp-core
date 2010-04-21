<?php

require_once('FireConsole/Dispatcher.php');

class FirePHP_Insight_Dispatcher extends FireConsole_Dispatcher
{
    const SENDER_ID = 'http://registry.pinf.org/cadorn.org/github/firephp-libs/packages/insight/';
    const RECEIVER_ID = 'http://registry.pinf.org/developercompanion.com/@meta/receiver/console/0.1.0';
    

    private function getSenderID() {
        return SENDER_ID;
    }

    private function getReceiverID() {
        return RECEIVER_ID;
    }
}
