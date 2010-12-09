<?php

// TODO: Configure FirePHP
//define('FIREPHP_ACTIVATED', true); // Ensure FirePHP is always collecting data
//require_once('FirePHP/Init.php');        


// listen to all data that would be sent to client (if authorized)
class PayloadListener {
    public function onPayload($request, $payload) {
        parsePayload($payload);
    }
}
Insight_Helper::getInstance()->registerListener('payload', new PayloadListener());


// parse data and fire the receiver for each message
function parsePayload($data) {
    $data = explode("\n", $data);
    $headers = array();
    foreach( $data as $header ) {
        $index = strpos($header, ":");
        if($index>5) { // sanity check
            $headers[substr($header, 0, $index)] = trim(substr($header, $index+1));
        }
    }
    require_once('Wildfire/Channel/Memory.php');
    $memoryChannel = new Wildfire_Channel_Memory();
    $receiver = new Receiver();
    $receiver->setChannel($memoryChannel);
    // listen to messages intended for the 'page' context
    $receiver->addId('http://registry.pinf.org/cadorn.org/insight/@meta/receiver/console/page/0');
    // listen to messages intended for the 'request' context
    $receiver->addId('http://registry.pinf.org/cadorn.org/insight/@meta/receiver/console/request/0');
    $memoryChannel->parseReceived($headers);
}


require_once('Wildfire/Receiver.php');
class Receiver extends Wildfire_Receiver
{
    public function getProtocol() {
        // TODO: return "*" so all protocols are captured?
        return 'http://registry.pinf.org/cadorn.org/wildfire/@meta/protocol/component/0.1.0';
    }

    public function onMessageReceived(Wildfire_Message $message)
    {
        echo('<pre>');
        var_dump($message->getReceiver());
        var_dump(json_decode($message->getMeta(), true));
        var_dump(json_decode($message->getData(), true));
        echo('</pre>');
    }
}


$console = FirePHP::to('page')->console();
$console->label('Label 1')->log('Hello World 1');

$console = FirePHP::to('request')->console();
$console->label('Label 2')->log('Hello World 2');
