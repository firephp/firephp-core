<?php

$plugins = FirePHP::to("plugin"); 

$plugin = $plugins->plugin('PageControls1');

$plugin->sendSimpleMessage("First Message");
$plugin->sendSimpleMessage(array(
    "Second" => "Message"
));

$plugin->show();
