<?php

$plugins = FirePHP::to("plugin"); 

$plugin = $plugins->plugin('PageControls1');

$plugin->sendSimpleMessage("First Message");

$plugin->show();




class Autoloader {
    static public function load($name) {
        if($name=='FirePHP_Examples_PageControls1_Plugin') {
            require_once(dirname(__FILE__) . '/plugins/PageControls1/lib/Plugin.php');
        }
    }
}
spl_autoload_register('Autoloader::load');


$plugins = FirePHP::to("plugin"); 

// assumes class (second argument) can be loaded by autoloader
$plugin = $plugins->plugin('PageControls1', 'FirePHP_Examples_PageControls1_Plugin');

$plugin->getInstance()->sendSimpleMessage(array(
    "Second" => "Message"
));




$plugins = FirePHP::to("plugin");

$plugin = $plugins->plugin('PageControls1');
/* NOTE: This is commented out as it will throw (multiple registrations for same plugin) but illustrates how it an be used
$plugin->register(array(
    'class' => 'FirePHP_Examples_PageControls1_Plugin',
    'file' => dirname(__FILE__) . '/plugins/PageControls1/lib/Plugin.php'
));
*/
$plugin->getInstance()->sendSimpleMessage(array(
    "Third" => "Message"
));




$plugins = FirePHP::to("plugin"); 

$plugin = $plugins->plugin('PageControls1');

// assumes class (second argument) can be loaded by autoloader
/* NOTE: This is commented out as it will throw (multiple registrations for same plugin) but illustrates how it an be used
$plugin->register(array(
    'class' => 'FirePHP_Examples_PageControls1_Plugin'
));
*/
$plugin->getInstance()->sendSimpleMessage(array(
    "Fourth" => "Message"
));




$plugins = FirePHP::to("plugin"); 

$plugin = $plugins->plugin('PageControls1');

// this works because
//  * $plugins->plugin('PageControls1', 'FirePHP_Examples_PageControls1_Plugin') or
//  * $plugin->register()
// was called above
$plugin->getInstance()->sendSimpleMessage(array(
    "Fifth" => "Message"
));

